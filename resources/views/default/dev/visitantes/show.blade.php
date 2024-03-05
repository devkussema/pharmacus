@extends('home.index')

@section('titulo', 'Visitantes')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session')
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Visitantes</h4>
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
                                <th>IP</th>
                                <th>Pais</th>
                                <th>Provincia/Estado</th>
                                <th>Referência</th>
                                <th>Navegador</th>
                                <th>Dispositivo</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($visitantes as $vs)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>{{ $vs->ip }}</td>
                                    <td>{{ $vs->country }}</td>
                                    <td>{{ $vs->state }}</td>
                                    <td>{{ $vs->referrer }}</td>
                                    <td>{{ getBrowserName($vs->browser) }}</td>
                                    <td>{{ getDeviceTipo($vs->device) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
