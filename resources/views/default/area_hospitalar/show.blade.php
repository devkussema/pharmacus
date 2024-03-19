@extends('home.index')

@section('titulo', 'Áreas Hospitalares')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session')
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Áreas Hospitalares</h4>
                        <p class="mb-0">Setores hospitalares são componentes fundamentais de hospitais,<br>
                            compreendendo áreas como emergência,
                            terapia intensiva, laboratórios e enfermarias.</p>

                    </div>
                    <a href="#" data-toggle="modal" data-target="#area_hospitalar" class="btn btn-primary add-list">
                        <i class="las la-plus mr-3"></i>
                        Adicionar
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                {{--<div class="table-responsive rounded mb-3">
                    <div class="row justify-content-between">
                        <div class="col-sm-6 col-md-6">
                            <div class="user-list-files d-flex">
                                <a class="bg-primary" id="print_ah" href="javascript:void();">
                                    Print
                                </a>
                                <a class="bg-primary" id="export_excel" href="javascript:void();">
                                    Excel
                                </a>
                                <a class="bg-primary" id="export_pdf" href="javascript:void();">
                                    Pdf
                                </a>
                            </div>
                        </div>
                    </div>--}}
                    <table class="data-table table mb-0 tbl-server-info tbl-area_hospitalar">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th class="hide-on-print">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($ah as $a)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>{{ $a->area_hospitalar->nome }}</td>
                                    <td>{{ $a->area_hospitalar->descricao }}</td>
                                    <td class="hide-on-print">
                                        <div class="d-flex align-items-center list-action">
                                            @if (isCargo('Gerente'))
                                                <a class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Adicionar Responsável" href="javascript:void(0)"
                                                    onclick="modalAddCargoAH('{{ $a->area_hospitalar->id }}')">
                                                    <i class="ri-key-2-line mr-0"></i>
                                                </a>
                                            @endif
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Editar" href="javascript:void(0)"
                                                onclick="modalEditarAH('{{ $a->area_hospitalar->id }}')">
                                                <i class="ri-pencil-line mr-0"></i>
                                            </a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Eliminar" href="javascript:void(0)"
                                                onclick="modalEliminarAH('{{ $a->area_hospitalar->id }}', '{{ $a->id  }}')">
                                                <i class="ri-delete-bin-line mr-0"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('modals._addAreaHospitalar')

    <style>
        /* Estilo para ocultar elementos durante a impressão */
        @media print {
            .hide-on-print {
                display: none;
            }
        }
    </style>
    <script>
        // Capturar os cliques nos links de impressão, exportação para Excel e PDF
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('print_ah').addEventListener('click', function() {
                window.print(); // Impressão da página
            });

            document.getElementById('export_excel').addEventListener('click', function() {
                exportToExcel(); // Função para exportar para Excel
            });

            document.getElementById('export_pdf').addEventListener('click', function() {
                exportToPdf(); // Função para exportar para PDF
            });
        });

        // Função para exportar para Excel
        function exportToExcel() {
            // Lógica para exportar para Excel
        }

        // Função para exportar para PDF
        function exportToPdf() {
            // Lógica para exportar para PDF
        }
    </script>
@endsection
