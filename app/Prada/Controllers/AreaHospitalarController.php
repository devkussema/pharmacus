<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Mail, Hash, Auth};
use App\Models\UserAreaHospitalar;
use App\Mail\ConfirmarContaGerenteAH as CCG;
use App\Models\{UserAreaHospitalar as UAH, AreaHospitalar as AH, User, Cargo, FarmaciaAreaHospitalar as FAH};
use App\Traits\GenerateTrait;

class AreaHospitalarController extends Controller
{
    use GenerateTrait;

    public function index()
    {
        $ah = FAH::where('farmacia_id', Auth::user()->isFarmacia->farmacia->id)->get();
        return view('area_hospitalar.show', compact('ah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|exists:areas_hospitalares,id',
            'farmacia_id' => 'required|exists:farmacias,id',
            'descricao' => 'nullable'
        ], [
            'area_id.required' => 'Selecione uma área válida', //farmacia_id
            'area_id.exists' => 'Por favor tente novamente',
            'farmacia_id.required' => 'Por favor recarregue a página e tente novamente',
        ]);

        AH::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'farmacia_id' => Auth::user()->isFarmacia->farmacia->id,
        ]);

        return response()->json(['message' => "{$request->nome} cadastrada com sucesso"], 201);
    }

    public function addCargo(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'cargo_id' => 'required|exists:cargos,id',
            'area_id' => 'required|exists:areas_hospitalares,id',
            'contato' => 'required'
        ],[
            'email.required' => "O email é obrigatório",
            'email.unique' => "Este email já está a ser usado",
            'cargo_id.required' => "Selecione um cargo",
            'cargo.exists' => "Selecione um cargo válido",
            'area_id' => 'Por favor selecione uma área primeiro',
            'area_id.exists' => "Por favor selecione uma área hospitalar válida",
            'contato.required' => "Informe um número de telefone válido"
        ]);

        $ah = AH::find($request->area_id);
        $cargo = Cargo::find($request->cargo_id);

        $user = User::create([
            'nome' => "Responsável {$ah->nome}",
            'email' => $request->email,
            'password' => Hash::make(self::gerarSenhaAutomatica())
        ]);

        UAH::create([
            'user_id' => $user->id,
            'area_hospitalar_id' => $request->area_id,
            'cargo_id' => $request->cargo_id,
            'contato' => $request->contato
        ]);

        $token = self::gerarToken($user);
        $url = route('confirmar.funcionario', ['token' => $token->token]);

        Mail::to($request->email)->send(new CCG($url));

        return response()->json(['message' => "Um email para o {$cargo->nome} foi enviado."]);
    }

    public function getStatDia()
    {
        $contagemPorDia = [
            'Segunda-feira' => AH::calcularContagemParaDia('Monday'),
            'Terça-feira' => AH::calcularContagemParaDia('Tuesday'),
            'Quarta-feira' => AH::calcularContagemParaDia('Wednesday'),
            'Quinta-feira' => AH::calcularContagemParaDia('Thursday'),
            'Sexta-feira' => AH::calcularContagemParaDia('Friday'),
            'Sábado' => AH::calcularContagemParaDia('Saturday'),
            'Domingo' => AH::calcularContagemParaDia('Sunday'),
        ];

        return response()->json($contagemPorDia);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|unique:areas_hospitalares,nome,' . $id,
            'descricao' => 'nullable'
        ], [
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'Esta área já está cadastrada no sistema'
        ]);

        $area_hospitalar = AH::findOrFail($id);
        $area_hospitalar->update($request->all());

        return response()->json(['message' => "{$area_hospitalar->nome} atualizada com sucesso"], 200);
    }

    public function destroy(Request $request, $id)
    {
        $area_hospitalar = AH::find($id);

        if (!$area_hospitalar) {
            return response()->json(['message' => 'Área hospitalar não encontrada'], 404);
        }

        $area_hospitalar->delete();

        if ($request->ajax())
            return response()->json(['message' => 'Área hospitalar excluída com sucesso']);
        return redirect()->route('a_h.index')->with('success', "{$area_hospitalar->nome} eliminada com sucesso");
    }

    public function getAll()
    {
        $all = AH::all();

        return response()->json($all);
    }

    public function getInfo($id)
    {
        $info = AH::find($id);

        if (!$info)
            return response()->json(['message' => "Selecione uma Área Hospitalar"], 401);

        return response()->json($info);
    }
}
