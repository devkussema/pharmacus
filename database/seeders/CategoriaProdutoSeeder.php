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
        Categoria::create([
            'nome' => 'Medicamentos de prescrição',
            'tipo' => 'produto',
            'descricao' => 'Produtos que requerem uma prescrição médica para serem adquiridos, geralmente para o tratamento de condições de saúde específicas.'
        ]);

        Categoria::create([
            'nome' => 'Medicamentos de venda livre (OTC - Over-the-counter)',
            'tipo' => 'produto',
            'descricao' => 'Produtos que podem ser adquiridos sem a necessidade de uma prescrição médica, geralmente para o tratamento de condições menores como dor de cabeça, resfriados, alergias, etc.'
        ]);

        Categoria::create([
            'nome' => 'Injetáveis',
            'tipo' => 'produto',
            'descricao' => 'Produtos farmacêuticos que são administrados por meio de injeção, como vacinas, insulina, e outros medicamentos injetáveis.'
        ]);

        Categoria::create([
            'nome' => 'Aerosóis',
            'tipo' => 'produto',
            'descricao' => 'Produtos que são administrados por meio de aerossolização, como sprays nasais, sprays para a garganta, e inaladores para tratamento de asma.'
        ]);

        Categoria::create([
            'nome' => 'Oral sólidos',
            'tipo' => 'produto',
            'descricao' => 'Produtos farmacêuticos que são administrados por via oral na forma de comprimidos, cápsulas, comprimidos mastigáveis, entre outros.'
        ]);

        Categoria::create([
            'nome' => 'Tópicos',
            'tipo' => 'produto',
            'descricao' => 'Produtos que são aplicados na superfície da pele ou em uma membrana mucosa, como pomadas, cremes, loções, e géis.'
        ]);

        Categoria::create([
            'nome' => 'Suplementos nutricionais',
            'tipo' => 'produto',
            'descricao' => 'Produtos que fornecem nutrientes adicionais ao corpo, como vitaminas, minerais, aminoácidos, e outros suplementos dietéticos.'
        ]);

        Categoria::create([
            'nome' => 'Homeopáticos',
            'tipo' => 'produto',
            'descricao' => 'Produtos baseados na prática da homeopatia, que envolve a utilização de substâncias altamente diluídas para tratar diversas condições de saúde.'
        ]);

        Categoria::create([
            'nome' => 'Fitoterápicos',
            'tipo' => 'produto',
            'descricao' => 'Produtos derivados de plantas medicinais, usados para prevenir, aliviar ou tratar várias condições de saúde.'
        ]);

        Categoria::create([
            'nome' => 'Cosméticos',
            'tipo' => 'produto',
            'descricao' => 'Produtos utilizados para melhorar a aparência física, como cremes hidratantes, protetores solares, maquiagens, entre outros.'
        ]);
    }
}
