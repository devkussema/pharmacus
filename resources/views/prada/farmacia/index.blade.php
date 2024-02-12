@extends('home.index')

@section('titulo', 'Fármacias')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Lista de Farmácias</h4>
                        <p class="mb-0">
                            Farmácias são vitais para a oferta de produtos e serviços de saúde, garantindo<br>
                            uma apresentação atrativa e informativa para os clientes.
                        </p>
                    </div>
                    <a href="#" class="btn btn-primary add-list" data-toggle="modal" data-target="#addFarmacia"><i
                            class="las la-plus mr-3"></i>
                        Adicionar
                    </a>
                </div>
                @include('partials.session')
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table id="datatable" class="table data-table table-striped">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Nome</th>
                                <th>Código</th>
                                <th>Status</th>
                                <th>Categoria</th>
                                <th>Endereço</th>
                                <th>OBS</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($farmacias as $farmacia)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if (!$farmacia->logo)
                                                <img src="assets/images/table/product/01.jpg"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            @else
                                                <img src="{{ asset('storage/' . $farmacia->logo) }}"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            @endif
                                            <div>
                                                {{ $farmacia->nome }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $farmacia->codigo }}</td>
                                    <td>
                                        @if ($farmacia->status)
                                            Ativa
                                        @else
                                            Inativa
                                        @endif
                                    </td>
                                    <td>{{ @$farmacia->categoria->nome }}</td>
                                    <td>{{ $farmacia->endereco }}</td>
                                    <td>{{ $farmacia->obs }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="View" href="javascript:void(0)"><i
                                                    class="ri-eye-line mr-0"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="badge bg-success mr-2"
                                                onclick="getDataFarma('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')"
                                                title="Editar {{ $farmacia->nome }}">
                                                <i class="ri-pencil-line mr-0"></i>
                                            </a>
                                            <a class="badge bg-info mr-2" href="javascript:void(0)"
                                                onclick="preencherModalComFarmacia('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')">
                                                <i class="ri-bubble-chart-line"></i>
                                            </a>
                                            <a class="badge bg-warning mr-2" title="Eliminar {{ $farmacia->nome }}" href="javascript:void(0)" onclick="modalEliminarFarmacia('{{ $farmacia->id }}')">
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
    @include('modals._addGerenteFarmacia')
    @include('modals._editarFarmacia')
@endsection
