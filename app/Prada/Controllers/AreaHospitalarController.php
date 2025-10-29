<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Mail, Hash, Auth};
use App\Models\UserAreaHospitalar;
use App\Mail\ConfirmarContaGerenteAH as CCG;
use App\Models\{Grupo, UserAreaHospitalar as UAH, AreaHospitalar as AH, User, Cargo, FarmaciaAreaHospitalar as FAH};
use App\Mail\ConfirmarDesignacaoAH;
use App\Traits\GenerateTrait;

class AreaHospitalarController extends Controller
{
    use GenerateTrait;

    public function index()
    {
        /**
         * Lista as áreas hospitalares associadas à farmácia do usuário autenticado.
         *
         * @author Augusto Kussema
         * @created 2025-09-27
         * @return \Illuminate\Contracts\View\View
         */
        $farmacia_id = null;
        try {
            $farmacia_id = Auth::user()->isFarmacia->farmacia->id ?? Auth::user()->farmacia->farmacia_id ?? null;
        } catch (\Throwable $e) {
            $farmacia_id = null;
        }

        $ah = collect();
        if ($farmacia_id) {
            // eager load da área hospitalar para evitar consultas por linha na view
            $ah = FAH::where('farmacia_id', $farmacia_id)
                ->with('area_hospitalar')
                ->get();
        }

        return view('area_hospitalar.show', compact('ah', 'farmacia_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|exists:areas_hospitalares,id',
            'farmacia_id' => 'required|exists:farmacias,id',
            'descricao' => 'nullable',
            'log_estoque' => 'nullable|boolean'
        ], [
            'area_id.required' => 'Selecione uma área válida', //farmacia_id
            'area_id.exists' => 'Por favor tente novamente',
            'farmacia_id.required' => 'Por favor recarregue a página e tente novamente',
        ]);

        FAH::create([
            'area_hospitalar_id' => $request->area_id,
            'farmacia_id' => $request->farmacia_id,
            'log_estoque' => $request->has('log_estoque') ? 1 : 0,
        ]);

        return response()->json(['message' => "Área Hospitalar cadastrada."], 201);
    }

    /**
     * Atualiza apenas a flag log_estoque de um registro farmacia_areas_hospitalares
     * Recebe: log_estoque (0/1)
     * @param Request $request
     * @param int $id FAH id
     * @return \Illuminate\Http\JsonResponse
     */
    public function setLogEstoque(Request $request, $id)
    {
        $request->validate([
            'log_estoque' => 'required|boolean'
        ]);

        $fah = FAH::find($id);
        if (!$fah) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $fah->log_estoque = $request->input('log_estoque') ? 1 : 0;
        $fah->save();

        return response()->json(['message' => 'Flag atualizada', 'log_estoque' => $fah->log_estoque], 200);
    }

    public function addCargo(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'cargo_id' => 'required|exists:cargos,id',
            'area_id' => 'required|exists:areas_hospitalares,id',
            'farmacia_id' => 'required|exists:farmacias,id',
            'contato' => 'required'
        ],[
            'email.required' => "O email é obrigatório",
            'email.unique' => "Este email já está a ser usado",
            'cargo_id.required' => "Selecione um cargo",
            'cargo.exists' => "Selecione um cargo válido",
            'area_id' => 'Por favor selecione uma área primeiro',
            'area_id.exists' => "Por favor selecione uma área hospitalar válida",
            'farmacia_id.required' => "Algo deu errado, recarregue a página e tente de novo",
            'farmacia_id.exists' => "Algo deu errado, recarregue a página e tente de novo",
            'contato.required' => "Informe um número de telefone válido"
        ]);

        $ah = AH::find($request->area_id);
        $cargo = Cargo::find($request->cargo_id);
        $farmacia = \App\Models\Farmacia::find($request->farmacia_id);

        $grupo = Grupo::where('nome', 'Funcionário AH')->first();

        $user = User::create([
            'nome' => "Responsável {$ah->nome}",
            'email' => $request->email,
            'grupo_id' => $grupo->id,
            'password' => Hash::make(self::gerarSenhaAutomatica())
        ]);

        UAH::create([
            'user_id' => $user->id,
            'area_hospitalar_id' => $request->area_id,
            'cargo_id' => $request->cargo_id,
            'farmacia_id' => $request->farmacia_id,
            'contato' => $request->contato
        ]);

        $token = self::gerarToken($user);
        $linkConfirmacao = route('confirmar.funcionario', ['token' => $token->token]);

        // Dados para o email
        $dadosEmail = [
            'usuario' => $user,
            'cargo' => $cargo,
            'areaHospitalar' => $ah,
            'farmacia' => $farmacia,
            'linkConfirmacao' => $linkConfirmacao,
            'dataDesignacao' => now(),
            'tempoExpiracao' => '48 horas',
            'assunto' => 'Confirmação de Designação - ' . $cargo->nome,
            'mensagemPersonalizada' => "Foi designado(a) como {$cargo->nome} na área {$ah->nome}. Por favor, confirme a sua designação para ativar o seu acesso ao sistema."
        ];

        // Enviar email com dados completos
        Mail::to($request->email)->send(new ConfirmarDesignacaoAH($dadosEmail));

        return redirect()->back()->with('info', "Um email para o {$cargo->nome} foi enviado.");
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
        $area_hospitalar = FAH::find($id);

        if (!$area_hospitalar) {
            return response()->json(['message' => 'Área hospitalar não encontrada'], 404);
        }

        $area_hospitalar->delete();

        if ($request->ajax())
            return response()->json(['message' => 'Área hospitalar excluída com sucesso']);
        return redirect()->route('a_h.index')->with('success', "{$area_hospitalar->area_hospitalar->nome} eliminada com sucesso");
    }

    /**
     * Toggle status (ativo/inativo) da relação farmacia_areas_hospitalares
     */
    public function toggleStatus(Request $request, $id)
    {
        $fah = FAH::find($id);

        if (!$fah) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $fah->status = $fah->status ? 0 : 1;
        $fah->save();

        return response()->json(['message' => 'Status atualizado', 'status' => $fah->status], 200);
    }

    public function getAll()
    {
        $all = AH::all();

        return response()->json($all);
    }

    public function getAllMy($id_def)
    {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;
        $all = FAH::where('farmacia_id', $farmacia_id)
          //->where('area_hospitalar_id', '!=', $id_def)
          ->with('area_hospitalar', 'farmacia')
          ->get();

        return response()->json($all);
    }

    public function getInfo($id)
    {
        $info = AH::find($id);

        if (!$info)
            return response()->json(['message' => "Selecione uma Área Hospitalar"], 401);

        return response()->json($info);
    }

    /**
     * Retorna a relação FarmaciaAreaHospitalar por id (inclui area_hospitalar)
     * usado para popular o modal de edição (AJAX)
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFAH($id)
    {
        $fah = FAH::with('area_hospitalar')->find($id);

        if (!$fah) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($fah);
    }
}
