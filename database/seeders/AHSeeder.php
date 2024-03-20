<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AreaHospitalar;

class AHSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areasHospitalares = [
            ['nome' => 'Hemoterapia', 'descricao' => 'Tratamento relacionado ao sangue.'],
            ['nome' => 'CATV', 'descricao' => 'Terapia de câncer assistida por computador.'],
            ['nome' => 'Farmácia', 'descricao' => 'Gerenciamento e distribuição de medicamentos.'],
            ['nome' => 'G. Farmácia', 'descricao' => 'Gerenciamento específico de medicamentos.'],
            ['nome' => 'Armazém II', 'descricao' => 'Estoque de suprimentos hospitalares.'],
            ['nome' => 'Armazém I', 'descricao' => 'Estoque de suprimentos hospitalares.'],
            ['nome' => 'Pediatria internamento', 'descricao' => 'Internamento de pacientes pediátricos.'],
            ['nome' => 'Maternidade internamento', 'descricao' => 'Internamento de pacientes gestantes.'],
            ['nome' => 'Berçário', 'descricao' => 'Local de cuidados para recém-nascidos.'],
            ['nome' => 'Estomatologia', 'descricao' => 'Tratamento odontológico especializado.'],
            ['nome' => 'Maternidade', 'descricao' => 'Atendimento a gestantes e parturientes.'],
            ['nome' => 'Sala de parto', 'descricao' => 'Local de partos e assistência obstétrica.'],
            ['nome' => 'Banco de urgência da maternidade', 'descricao' => 'Atendimento de emergência para gestantes.'],
            ['nome' => 'Bloco operatório', 'descricao' => 'Local para cirurgias.'],
            ['nome' => 'Direcção clínica', 'descricao' => 'Gestão clínica e administrativa do hospital.'],
            ['nome' => 'Pediatria consulta externa', 'descricao' => 'Atendimento pediátrico ambulatorial.'],
            ['nome' => 'Pav', 'descricao' => 'Local de internamento e tratamento de pacientes.'],
            ['nome' => 'Pequena cirurgia', 'descricao' => 'Procedimentos cirúrgicos menores.'],
            ['nome' => 'Fisioterapia', 'descricao' => 'Reabilitação física e terapia ocupacional.'],
            ['nome' => 'Planeamento familiar', 'descricao' => 'Atendimento e aconselhamento em planejamento familiar.'],
            ['nome' => 'Banco de urgência pediátrico', 'descricao' => 'Atendimento de emergência pediátrica.'],
            ['nome' => 'Tisiologia', 'descricao' => 'Tratamento e controle de tuberculose.'],
            ['nome' => 'Maqueiros', 'descricao' => 'Profissionais responsáveis pelo transporte de pacientes.'],
            ['nome' => 'Electro-medicina', 'descricao' => 'Manutenção e suporte de equipamentos médicos.'],
            ['nome' => 'Motoristas', 'descricao' => 'Motoristas responsáveis pelo transporte hospitalar.'],
            ['nome' => 'Electricistas', 'descricao' => 'Profissionais responsáveis pela manutenção elétrica.'],
            ['nome' => 'Serviços gerais', 'descricao' => 'Equipe responsável pela limpeza e manutenção geral.'],
            ['nome' => 'Secretários clínicos', 'descricao' => 'Assistentes administrativos na área clínica.'],
            ['nome' => 'Gabinete do utente', 'descricao' => 'Atendimento e suporte ao paciente.'],
            ['nome' => 'Laboratório', 'descricao' => 'Análises clínicas e diagnóstico laboratorial.'],
            ['nome' => 'Estatística', 'descricao' => 'Coleta e análise de dados estatísticos hospitalares.'],
            ['nome' => 'Património', 'descricao' => 'Gestão do patrimônio e infraestrutura hospitalar.'],
            ['nome' => 'Psicologia', 'descricao' => 'Avaliação e suporte psicológico aos pacientes.'],
            ['nome' => 'Consulta Pré Natal', 'descricao' => 'Acompanhamento médico de gestantes antes do parto.'],
            ['nome' => 'Ginecologia', 'descricao' => 'Atendimento médico especializado em saúde feminina.'],
        ];

        foreach ($areasHospitalares as $area) {
            AreaHospitalar::create($area);
        }
    }
}
