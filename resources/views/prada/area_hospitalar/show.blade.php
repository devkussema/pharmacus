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
                <div class="table-responsive rounded mb-3">
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
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            {{-- Gerado automaticamente --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('modals._addAreaHospitalar')
@endsection
