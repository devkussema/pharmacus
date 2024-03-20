<div class="modal fade" id="modalAddProdutoEstoque" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar Produto</h4>
                    <div class="content create-workform bg-body">
                        @php
                            $farmacia_id = "";
                            if (@auth()->user()->isFarmacia){
                                $farmacia_id = auth()->user()->isFarmacia->farmacia->id;
                            }elseif(@auth()->user()->farmacia) {
                                $farmacia_id = auth()->user()->farmacia->farmacia_id;
                            }
                        @endphp
                        <form id="formProdutoEstoque" method="POST" action="{{ route('estoque.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="col pb-3">
                                    <input type="hidden" name="farmacia_id" value="{{ $farmacia_id }}">
                                    <label class="mb-2">Designação *</label>
                                    <input type="text" id="designacao" class="form-control" placeholder="" name="designacao">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Tipo *</label>
                                    <select name="tipo" style="width: 100%" id="tipo_produto_estoque" class="form-control">
                                        <option selected disabled>Selecionar tipo</option>
                                        <option value="descartável">Descartável</option>
                                        <option value="medicamento">Medicamento</option>
                                        <option value="liquido">Liquido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="" id="item_medicamento" style="display:none">
                                <div class="form-row">
                                    {{-- <div class="col pb-3">
                                        <label class="mb-2">Quantidade em Estoque *</label>
                                        <input type="number" class="form-control" placeholder="" name="qtd">
                                    </div> --}}
                                    <div class="col pb-3">
                                        <label class="mb-2">Dosagem *</label>
                                        <input type="text" class="form-control" placeholder="" name="dosagem">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <hr>
                                <button type="button" id="btn_repetir_lote" class="btn btn-success mt-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="rgba(255,255,255,1)"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                                </button>
                            </div> --}}
                            <div class="" id="repetir_">
                                <div class="" id="item_descartavelq" style="">
                                    <div class="form-row">
                                        <div class="col pb-3">
                                            <label class="mb-2">Descritivo *</label>
                                            <input type="text" id="descritivo" class="form-control mask" oninput="addQtdTotal(this)" data-mask="99x999x999" name="descritivo">
                                        </div>
                                        <div class="col pb-3">
                                            <label class="mb-2">Total em unidades</label>
                                            <input type="number" id="qtd_total_estoque" class="form-control" name="qtd_total">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Lote *</label>
                                        <input type="text" class="form-control" name="num_lote">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Documento Nº *</label>
                                        <input type="number" id="cod_barras" class="form-control" placeholder="" name="num_documento">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Produção *</label>
                                        <input type="date" class="form-control" placeholder="" name="data_producao">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Expiração *</label>
                                        <input type="date" class="form-control" placeholder="" name="data_expiracao">
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="" id="diverso">
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Forma *</label>
                                        <input type="text" class="form-control" placeholder="" name="forma">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">G. Farmacológico *</label>
                                        <select name="grupo_farmaco_id" style="width: 100%" id="" class="form-control selectr2">
                                            @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Origem / Destino *</label>
                                        <input type="text" class="form-control" placeholder="" name="origem_destino">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Área Hospitalar</label>
                                    <select name="area_id" style="width: 100%" id="" class="form-control select2">
                                        @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                            @if ($ah->nome == 'Armazém I')
                                                <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--<div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Quantidade Embalagem</label>
                                    <input type="number" class="form-control" placeholder="" name="qtd_embalagem">
                                </div>
                            </div>--}}
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">OBS</label>
                                    <textarea class="form-control" placeholder="" name="obs"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <input id="input-addEstoqueFarma" class="btn btn-outline-primary" type="submit" hidden>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label for="input-addEstoqueFarma" class="btn btn-primary">Cadastrar</label>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditProdutoEstoque" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3" id="nome_produto">Editar Produto</h4>
                    <div class="content create-workform bg-body">
                        <form id="formEditProdutoEstoque" method="POST" action="{{ route('estoque.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Designação *</label>
                                    <input type="text" id="designacao" class="form-control" placeholder="" name="designacao">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Tipo *</label>
                                    <select name="tipo" style="width: 100%" id="tipo_produto_estoque" class="form-control">
                                        <option selected disabled>Selecionar tipo</option>
                                        <option value="descartável">Descartável</option>
                                        <option value="medicamento">Medicamento</option>
                                        <option value="liquido">Liquido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="" id="item_medicamento" style="display:none">
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Quantidade em Estoque *</label>
                                        <input type="number" id="qtd_estoque" class="form-control" placeholder="" name="qtd">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Dosagem *</label>
                                        <input type="text" id="dosagem" class="form-control" placeholder="" name="dosagem">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <hr>
                                <button type="button" id="btn_repetir_lote" class="btn btn-success mt-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="rgba(255,255,255,1)"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                                </button>
                            </div> --}}
                            <div class="" id="repetir_">
                                <div class="" id="item_descartavel" style="display: none">
                                    <div class="form-row">
                                        <div class="col pb-3">
                                            <label class="mb-2">Descritivo *</label>
                                            <input type="text" id="descritivo" class="form-control mask" oninput="addQtdTotal(this)" data-mask="99x99x99" name="descritivo">
                                        </div>
                                        <div class="col pb-3">
                                            <label class="mb-2">Total em unidades</label>
                                            <input type="number" id="qtd_total_estoque" class="form-control" name="qtd_total">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Lote *</label>
                                        <input type="text" class="form-control" id="num_lote" name="num_lote">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Documento Nº *</label>
                                        <input type="number" id="cod_barras" class="form-control" placeholder="" name="num_documento">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Produção *</label>
                                        <input type="date" class="form-control" id="data_producao" name="data_producao">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Expiração *</label>
                                        <input type="date" class="form-control" id="data_expiracao" name="data_expiracao">
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="" id="diverso">
                                <div class="form-row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Forma *</label>
                                        <input type="text" class="form-control" id="forma" name="forma">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">G. Farmacológico *</label>
                                        <select name="grupo_farmaco_id" style="width: 100%" id="grupo_farmaco_id" class="form-control select2">
                                            @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Origem / Destino *</label>
                                        <input type="text" class="form-control" id="origem_destino" name="origem_destino">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Quantidade Embalagem</label>
                                    <input type="number" class="form-control" id="qtd_embalagem" name="qtd_embalagem">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">OBS</label>
                                    <textarea class="form-control" id="obs" name="obs"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <input id="input-addEstoqueFarma" class="btn btn-outline-primary" type="submit" hidden>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label for="input-addEstoqueFarma" class="btn btn-primary">Cadastrar</label>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
