<?php

namespace App\Exports;

use App\Models\ProdutoEstoque;
use Maatwebsite\Excel\Concerns\FromCollection;
class EstoqueExport
{
    protected $produtos;

    public function __construct($produtos)
    {
        $this->produtos = $produtos;
    }

    public function collection()
    {
        return $this->produtos;
    }

    public function headings(): array
    {
        return ['ID', 'Designação', 'Forma', 'Quantidade', 'Data de Expiração'];
    }
}
