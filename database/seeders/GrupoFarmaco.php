<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GrupoFarmacologico;

class GrupoFarmaco extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = [
            ['nome' => 'Analgésico', 'descricao' => 'Medicamentos utilizados para aliviar a dor.'],
            ['nome' => 'Antibiótico', 'descricao' => 'Medicamentos que combatem infecções bacterianas.'],
            ['nome' => 'Diurético', 'descricao' => 'Medicamentos que aumentam a produção de urina.'],
            ['nome' => 'Anticoagulante', 'descricao' => 'Medicamentos que impedem a coagulação do sangue.'],
            ['nome' => 'Antihipertensivo', 'descricao' => 'Medicamentos utilizados para baixar a pressão arterial.'],
            ['nome' => 'AINEs', 'descricao' => 'Anti-inflamatórios não esteroides.'],
            ['nome' => 'Antidepressivos', 'descricao' => 'Medicamentos utilizados para tratar a depressão.'],
            ['nome' => 'Antidiabético', 'descricao' => 'Medicamentos utilizados para tratar a diabetes.'],
            ['nome' => 'Agentes Cardiovasculares', 'descricao' => 'Medicamentos que afetam o sistema cardiovascular.'],
            ['nome' => 'Meios de Diagnóstico', 'descricao' => 'Substâncias utilizadas para diagnóstico médico.'],
            ['nome' => 'Multivitamina', 'descricao' => 'Suplementos que contêm várias vitaminas.'],
            ['nome' => 'Vitamina Hidrossolúvel', 'descricao' => 'Vitaminas solúveis em água.'],
            ['nome' => 'Vitamina Lipossolúvel', 'descricao' => 'Vitaminas solúveis em gordura.'],
            ['nome' => 'Glicocorticoides', 'descricao' => 'Hormônios esteroides anti-inflamatórios.'],
            ['nome' => 'Antihistamínicos I', 'descricao' => 'Medicamentos utilizados para tratar alergias.'],
            ['nome' => 'Antihistamínicos II', 'descricao' => 'Medicamentos utilizados para tratar alergias mais graves.'],
            ['nome' => 'Soros', 'descricao' => 'Preparações líquidas de sangue ou plasma usadas para tratar certas condições médicas.'],
            ['nome' => 'Desinfetante', 'descricao' => 'Substâncias que matam microrganismos.'],
            ['nome' => 'Desparasitante', 'descricao' => 'Medicamentos usados para tratar infestações parasitárias.'],
            ['nome' => 'Descartáveis', 'descricao' => 'Itens de uso único.'],
            ['nome' => 'Anestésico Local', 'descricao' => 'Medicamentos utilizados para adormecer uma área específica do corpo.'],
            ['nome' => 'Anestésico Geral', 'descricao' => 'Medicamentos utilizados para induzir a inconsciência.'],
            ['nome' => 'Vacina', 'descricao' => 'Preparações que estimulam o sistema imunológico para prevenir doenças.'],
            ['nome' => 'Reagente Laboratorial', 'descricao' => 'Substâncias usadas em testes laboratoriais.'],
            ['nome' => 'TDR (Teste de Diagnóstico Rápido)', 'descricao' => 'Testes utilizados para diagnosticar rapidamente certas condições.'],
            ['nome' => 'Antiviral', 'descricao' => 'Medicamentos utilizados para tratar infecções virais.'],
            ['nome' => 'Antirretroviral', 'descricao' => 'Medicamentos utilizados para tratar infecções pelo HIV.'],
            ['nome' => 'Antituberculoso', 'descricao' => 'Medicamentos utilizados para tratar a tuberculose.'],
        ];

        foreach ($grupos as $grupo) {
            GrupoFarmacologico::create($grupo);
        }
    }
}
