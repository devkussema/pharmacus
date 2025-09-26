<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed das categorias de produtos
        $lista = [
            ['nome' => 'Medicamentos de prescrição', 'descricao' => 'Produtos que requerem uma prescrição médica para serem adquiridos, geralmente para o tratamento de condições de saúde específicas.'],
            ['nome' => 'Medicamentos de venda livre (OTC - Over-the-counter)', 'descricao' => 'Produtos que podem ser adquiridos sem a necessidade de uma prescrição médica, geralmente para o tratamento de condições menores como dor de cabeça, resfriados, alergias, etc.'],
            ['nome' => 'Injetáveis', 'descricao' => 'Produtos farmacêuticos que são administrados por meio de injeção, como vacinas, insulina, e outros medicamentos injetáveis.'],
            ['nome' => 'Aerosóis', 'descricao' => 'Produtos que são administrados por meio de aerossolização, como sprays nasais, sprays para a garganta, e inaladores para tratamento de asma.'],
            ['nome' => 'Oral sólidos', 'descricao' => 'Produtos farmacêuticos que são administrados por via oral na forma de comprimidos, cápsulas, comprimidos mastigáveis, entre outros.'],
            ['nome' => 'Tópicos', 'descricao' => 'Produtos que são aplicados na superfície da pele ou em uma membrana mucosa, como pomadas, cremes, loções, e géis.'],
            ['nome' => 'Suplementos nutricionais', 'descricao' => 'Produtos que fornecem nutrientes adicionais ao corpo, como vitaminas, minerais, aminoácidos, e outros suplementos dietéticos.'],
            ['nome' => 'Homeopáticos', 'descricao' => 'Produtos baseados na prática da homeopatia, que envolve a utilização de substâncias altamente diluídas para tratar diversas condições de saúde.'],
            ['nome' => 'Fitoterápicos', 'descricao' => 'Produtos derivados de plantas medicinais, usados para prevenir, aliviar ou tratar várias condições de saúde.'],
            ['nome' => 'Cosméticos', 'descricao' => 'Produtos utilizados para melhorar a aparência física, como cremes hidratantes, protetores solares, maquiagens, entre outros.'],
        ];

        foreach ($lista as $item) {
            Categoria::firstOrCreate(
                ['nome' => $item['nome'], 'tipo' => 'produto'],
                ['descricao' => $item['descricao']]
            );
        }
    }
}
