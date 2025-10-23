@extends('admin::layout.main')

@section('title', 'Lista de Áreas Hospitalares')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table show-entire">
            <div class="card-body">

                <div class="page-table-header mb-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="doctor-table-blk">
                                <h3>Áreas Hospitalares</h3>
                                <div class="doctor-search-blk">
                                    <div class="top-nav-search table-search-blk">
                                        <form>
                                                <input type="text" class="form-control"
                                                    placeholder="Pesquise aqui">
                                                <a class="btn">
                                                    <img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt>
                                                </a>
                                        </form>
                                    </div>
                                    <div class="add-group">
                    <a href="javascript:;" class="btn btn-primary add-pluss ms-2"><img
                        src="{{ asset('assets/img/icons/plus.svg') }}" alt></a>
                    <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
                        src="{{ asset('assets/img/icons/re-fresh.svg') }}" alt></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">
                            <a href="javascript:;" class=" me-2">
                                <img src="{{ asset('prepharma/img/icons/pdf-icon-01.svg') }}" alt>
                            </a>
                            <a href="javascript:;" class=" me-2">
                                <img src="{{ asset('prepharma/img/icons/pdf-icon-02.svg') }}" alt>
                            </a>
                            <a href="javascript:;" class=" me-2">
                                <img src="{{ asset('prepharma/img/icons/pdf-icon-03.svg') }}" alt>
                            </a>
                            <a href="javascript:;">
                                <img src="{{ asset('prepharma/img/icons/pdf-icon-04.svg') }}" alt>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table border-0 custom-table comman-table datatable mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="all">
                                    </div>
                                </th>
                                <th>Área</th>
                                <th>Descrição</th>
                                <th>Estado</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($areas->sortBy(fn($a) => mb_strtolower($a->area_hospitalar?->nome ?? '')) as $area)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="{{ $area->id }}">
                                        </div>
                                    </td>
                                    <td>{{ $area->area_hospitalar?->nome ?? '—' }}</td>
                                    <td>{{ $area->area_hospitalar?->descricao ?? '—' }}</td>
                                    <td>
                                        @if($area->status === 'active' || $area->status === 1 || $area->status === '1')
                                            <button class="custom-badge status-green">Ativo</button>
                                        @else
                                            <button class="custom-badge status-red">Inativo</button>
                                        @endif
                                    </td>
                                    <td>{{ optional($area->created_at)->format('d.m.Y') }}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('cp.area_hospitalar.edit', $area->id) }}"><i class="fa-solid fa-pen-to-square m-r-5"></i> Editar</a>
                                                <form action="{{ route('cp.area_hospitalar.destroy', $area->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta área?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit"><i class="fa fa-trash-alt m-r-5"></i> Remover</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Nenhuma área encontrada para esta farmácia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection