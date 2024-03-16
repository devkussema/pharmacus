<div class="modal fade" id="area_hospitalar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Área Hospitalar</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddAH" method="POST" action="{{ route('a_h.index.store') }}">
                            @csrf
                            <div class="pb-3">
                                <label class="mb-2">Nome *</label>
                                    @php
                                        $areas = [];
                                        $areas = \App\Models\FarmaciaAreaHospitalar::where('farmacia_id', Auth::user()->isFarmacia->farmacia->id)->pluck('area_hospitalar_id')->toArray();
                                        $areas_hosp = \App\Models\AreaHospitalar::all();
                                    @endphp
                                    {{ in_array(5, $areas) }}
                                <select name="area_id" style="width: 100%" id="" class="form-control selectr2">
                                    @foreach ($areas_hosp as $ah)
                                        {{-- @if (!in_array($ah->id, $areas))
                                            <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                        @endif --}}
                                    @endforeach
                                </select>
                                <input type="hidden" name="farmacia_id" value="{{ auth()->user()->isFarmacia->farmacia->farmacia_id }}">
                            </div>
                            {{-- <div class="pb-3">
                                <label class="mb-2">Descrição (opcional)</label>
                                <textarea class="form-control" placeholder="Descrição da área" name="descricao"></textarea>
                            </div> --}}
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</div>
                                    <button class="btn btn-outline-primary" type="submit">Criar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editar_area_hospitalar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3" id="nome_area">Área Hospitalar</h4>
                    <div class="content create-workform bg-body">
                        <form id="formEditarAH" method="POST" action="{{ route('a_h.index.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="pb-3">
                                <label class="mb-2">Nome *</label>
                                <input type="text" class="form-control" id="nome" placeholder="Nome da área"
                                    name="nome">

                            </div>
                            <div class="pb-3">
                                <label class="mb-2">Descrição (opcional)</label>
                                <textarea class="form-control" id="descricao" placeholder="Descrição da área" name="descricao"></textarea>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</div>
                                    <button class="btn btn-outline-primary" type="submit">Criar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" id="modalEliminarAHp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="deleteFormAH" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Área Hospitalar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="texto-aviso"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Responsável da área --}}
<div class="modal fade" id="addResponsavelAH" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar Cargo AH</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddCargoAH" method="POST" action="{{ route('a_h.addCargo') }}">
                            @csrf
                            <div class="pb-3">
                                <label class="mb-2">Email *</label>
                                <input type="email" class="form-control" placeholder="" name="email">
                                <input type="hidden" id="area_hospitalar_id" class="form-control" placeholder="" name="area_id">
                            </div>
                            <div class="pb-3">
                                <label class="mb-2">Cargo *</label>
                                <select name="cargo_id" id="" class="form-control">
                                    @foreach (\App\Models\Cargo::all() as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pb-3">
                                <label class="mb-2">Telefone *</label>
                                <input type="text" class="form-control" placeholder="" name="contato">
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</div>
                                    <button class="btn btn-outline-primary" type="submit">Criar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
