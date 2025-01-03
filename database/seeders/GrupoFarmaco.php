<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GrupoFarmacologico;
use Illuminate\Support\Facades\DB;

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
            ['nome' => 'Antimicrobiano', 'descricao' => 'Medicamentos utilizados para matar ou inibir microrganismos.'],
            ['nome' => 'Antifúngico', 'descricao' => 'Medicamentos usados para tratar infecções fúngicas.'],
            ['nome' => 'Antiparasitário', 'descricao' => 'Medicamentos usados para tratar infecções parasitárias.'],
            ['nome' => 'Antiprotozoário', 'descricao' => 'Medicamentos usados para tratar infecções causadas por protozoários.'],
            ['nome' => 'Antiinflamatório', 'descricao' => 'Medicamentos usados para reduzir a inflamação.'],
            ['nome' => 'Broncodilatador', 'descricao' => 'Medicamentos usados para dilatar os brônquios e facilitar a respiração.'],
            ['nome' => 'Antiemético', 'descricao' => 'Medicamentos usados para prevenir náuseas e vômitos.'],
            ['nome' => 'Antipsicótico', 'descricao' => 'Medicamentos utilizados para tratar distúrbios psiquiátricos como esquizofrenia.'],
            ['nome' => 'Anticonvulsivante', 'descricao' => 'Medicamentos usados para prevenir ou tratar convulsões.'],
            ['nome' => 'Imunossupressor', 'descricao' => 'Medicamentos usados para suprimir o sistema imunológico.'],
            ['nome' => 'Antianêmico', 'descricao' => 'Medicamentos usados para tratar a anemia.'],
            ['nome' => 'Hipolipemiante', 'descricao' => 'Medicamentos usados para reduzir os níveis de lipídios no sangue.'],
            ['nome' => 'Hipoglicemiante', 'descricao' => 'Medicamentos usados para reduzir os níveis de glicose no sangue.'],
            ['nome' => 'Protetor Gástrico', 'descricao' => 'Medicamentos usados para proteger o estômago contra ácidos.'],
            ['nome' => 'Antidiarreico', 'descricao' => 'Medicamentos usados para tratar diarreia.'],
            ['nome' => 'Antifebril', 'descricao' => 'Medicamentos usados para reduzir a febre.'],
            ['nome' => 'Laxante', 'descricao' => 'Medicamentos usados para aliviar a constipação.'],
            ['nome' => 'Expectorante', 'descricao' => 'Medicamentos que ajudam a expelir secreções das vias respiratórias.'],
            ['nome' => 'Vasodilatador', 'descricao' => 'Medicamentos usados para dilatar os vasos sanguíneos.'],
            ['nome' => 'Antialérgico', 'descricao' => 'Medicamentos usados para aliviar os sintomas de alergias.'],
            ['nome' => 'Imunizante', 'descricao' => 'Medicamentos usados para estimular o sistema imunológico.'],
            ['nome' => 'Relaxante Muscular', 'descricao' => 'Medicamentos usados para relaxar os músculos.'],
            ['nome' => 'Antifúngico Tópico', 'descricao' => 'Medicamentos antifúngicos aplicados na pele ou mucosas.'],
            ['nome' => 'Antibiótico Tópico', 'descricao' => 'Medicamentos antibióticos aplicados na pele ou mucosas.'],
            ['nome' => 'Corticosteroide', 'descricao' => 'Medicamentos usados para reduzir inflamação e reações alérgicas.'],
            ['nome' => 'Anticorpos Monoclonais', 'descricao' => 'Medicamentos usados para tratar certos tipos de câncer e doenças autoimunes.'],
            ['nome' => 'Terapia Hormonal', 'descricao' => 'Medicamentos usados para reposição hormonal.'],
            ['nome' => 'Anorexígeno', 'descricao' => 'Medicamentos usados para reduzir o apetite.'],
            ['nome' => 'Anti-hiperlipidemiante', 'descricao' => 'Medicamentos usados para reduzir os níveis de lipídios no sangue.'],
            ['nome' => 'Antineoplásico', 'descricao' => 'Medicamentos usados no tratamento de câncer.'],
            ['nome' => 'Biológico', 'descricao' => 'Medicamentos derivados de organismos vivos para tratar doenças.'],
            ['nome' => 'Psicostimulante', 'descricao' => 'Medicamentos usados para aumentar a atividade do sistema nervoso central.'],
            ['nome' => 'Sanguíneo', 'descricao' => 'Medicamentos usados para tratar condições relacionadas ao sangue.'],
            ['nome' => 'Vitamínico', 'descricao' => 'Medicamentos e suplementos que contêm vitaminas.'],
            ['nome' => 'Suplemento Mineral', 'descricao' => 'Medicamentos que contêm minerais essenciais para o corpo.'],
            ['nome' => 'Probiotico', 'descricao' => 'Substâncias que ajudam a manter ou restaurar a flora intestinal.'],
            ['nome' => 'Enzimático', 'descricao' => 'Medicamentos que contêm enzimas para facilitar processos biológicos.'],
            ['nome' => 'Poder Antioxidante', 'descricao' => 'Medicamentos que combatem os radicais livres e ajudam a prevenir danos celulares.'],
            ['nome' => 'Análogos de Insulina', 'descricao' => 'Medicamentos usados no tratamento de diabetes tipo 1 e tipo 2.'],
            ['nome' => 'Terapia Genética', 'descricao' => 'Tratamentos que alteram ou reparam os genes para tratar doenças genéticas.'],
            ['nome' => 'Citoestático', 'descricao' => 'Medicamentos usados para tratar o câncer, que inibem a divisão celular.'],
            ['nome' => 'Toxina Botulínica', 'descricao' => 'Medicamentos utilizados para fins estéticos e médicos, como no tratamento de espasmos musculares.'],
            ['nome' => 'Drogas Psicotrópicas', 'descricao' => 'Medicamentos que alteram a percepção, o humor ou o comportamento.'],
            ['nome' => 'Antiespasmódico', 'descricao' => 'Medicamentos usados para aliviar espasmos musculares.'],
            ['nome' => 'Anticoagulante Oral', 'descricao' => 'Medicamentos orais usados para prevenir a coagulação do sangue.'],
            ['nome' => 'Antianestésico Local', 'descricao' => 'Medicamentos usados para induzir a perda de sensibilidade em uma área específica do corpo.'],
            ['nome' => 'Antimicrobiano Tópico', 'descricao' => 'Medicamentos antimicrobianos aplicados diretamente sobre a pele.'],
            ['nome' => 'Anticolinérgico', 'descricao' => 'Medicamentos que bloqueiam os efeitos da acetilcolina no sistema nervoso.'],
            ['nome' => 'Antagonista de Receptor', 'descricao' => 'Medicamentos que bloqueiam a ação de determinados receptores no corpo.'],
            ['nome' => 'Inibidor da Enzima de Conversão da Angiotensina (ECA)', 'descricao' => 'Medicamentos usados para tratar hipertensão e insuficiência cardíaca.'],
            ['nome' => 'Beta-bloqueador', 'descricao' => 'Medicamentos usados para tratar hipertensão, angina e problemas cardíacos.'],
            ['nome' => 'Antagonista de Cálcio', 'descricao' => 'Medicamentos usados para tratar hipertensão e angina.'],
            ['nome' => 'Antiandrógênico', 'descricao' => 'Medicamentos usados para bloquear os efeitos dos andrógenos (hormônios masculinos).'],
            ['nome' => 'Anticoncepcional', 'descricao' => 'Medicamentos usados para prevenir a gravidez.'],
            ['nome' => 'Terapia de Reposição', 'descricao' => 'Medicamentos usados para substituir substâncias que o corpo não produz em quantidade suficiente.'],
            ['nome' => 'Vasoconstritor', 'descricao' => 'Medicamentos que causam o estreitamento dos vasos sanguíneos, elevando a pressão arterial.'],
            ['nome' => 'Neurotransmissor', 'descricao' => 'Substâncias químicas que transmitem sinais entre os neurônios e outras células do corpo.'],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        GrupoFarmacologico::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($grupos as $grupo) {
            GrupoFarmacologico::create($grupo);
        }
    }
}
