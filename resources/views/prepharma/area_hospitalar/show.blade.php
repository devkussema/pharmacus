@extends('layout.app')

@section('titulo', 'Áreas Hospitalares')

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Áreas Hospitalares</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todas</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">

                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Todas Áreas Hospitalares</h3>
                                        <div class="doctor-search-blk">
                                            <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" class="form-control" placeholder="Procure aqui">
                                                    <a class="btn"><img src="{{ assetr('assets/img/icons/search-normal.svg')}}" alt></a>
                                                </form>
                                            </div>
                                            <div class="add-group">
                                                <a href="add-department.html" class="btn btn-primary add-pluss ms-2"><img
                                                        src="{{ assetr('assets/img/icons/plus.svg')}}" alt></a>
                                                <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
                                                        src="{{ assetr('assets/img/icons/re-fresh.svg')}}" alt></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="javascript:;" class=" me-2"><img src="{{ assetr('assets/img/icons/pdf-icon-01.svg')}}"
                                            alt></a>
                                    <a href="javascript:;" class=" me-2"><img src="{{ assetr('assets/img/icons/pdf-icon-02.svg')}}"
                                            alt></a>
                                    <a href="javascript:;" class=" me-2"><img src="{{ assetr('assets/img/icons/pdf-icon-03.svg')}}"
                                            alt></a>
                                    <a href="javascript:;"><img src="{{ assetr('assets/img/icons/pdf-icon-04.svg')}}" alt></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @if (isCargo('Gerente'))
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="modalAddCargoAH('{{ $a->area_hospitalar->id }}')">
                                                        <i class="fa-solid fa-pen-to-square m-r-5"></i>
                                                        Adicionar Responsável
                                                    </a>
                                                @endif
                                                <a class="dropdown-item" href="edit-department.html">
                                                    <i class="fa-solid fa-pen-to-square m-r-5"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_patient">
                                                    <i class="fa fa-trash-alt m-r-5"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                                        {{-- <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>Cardiology</td>
                                            <td class="profile-image"><a href="profile.html"><img width="28" height="28"
                                                        src="{{ assetr('assets/img/profiles/avatar-01.jpg')}}" class="rounded-circle m-r-5"
                                                        alt> Dr.Andrea Lalema</a></td>
                                            <td>Investigates and treats proble...</td>
                                            <td>01.10.2022</td>
                                            <td><button class="custom-badge status-green ">Active</button></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="edit-department.html"><i
                                                                class="fa-solid fa-pen-to-square m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_patient"><i
                                                                class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddCargoAH" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Adicionar Cargo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddCargoAH" method="POST" action="{{ route('a_h.addCargo') }}">
                            @csrf
                            <div class="pb-3">
                                <label class="mb-2" for="email_">Email *</label>
                                <input type="email" id="email_" class="form-control" placeholder="" name="email">
                                <input type="hidden" id="area_hospitalar_id" class="form-control" placeholder="" name="area_id">
                                <input type="hidden" value="{{ auth()->user()->isFarmacia->farmacia->id }}" class="form-control" placeholder="" name="farmacia_id">
                            </div>
                            <div class="pb-3">
                                <label class="mb-2" for="cargo_">Cargo *</label>
                                <select name="cargo_id" id="cargo_" class="form-control">
                                    @foreach (\App\Models\Cargo::all() as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pb-3">
                                <label class="mb-2" for="telefone_">Telefone *</label>
                                <input type="text" id="telefone_" class="form-control" placeholder="" name="contato">
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modalAddCargoAH(area_id) {
            $('#AddCargoAH h4#tituloModal').val(area_id);
            $('#AddCargoAH #area_hospitalar_id').val(area_id);
            $('#AddCargoAH').modal('show');
        }
    </script>
@endsection
