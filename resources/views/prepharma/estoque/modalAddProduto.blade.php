<div id="modalAddProduto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar Produto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                @php
                    $farmacia_id = '';
                    if (@auth()->user()->isFarmacia) {
                        $farmacia_id = auth()->user()->isFarmacia->farmacia->id;
                    } elseif (@auth()->user()->farmacia) {
                        $farmacia_id = auth()->user()->farmacia->farmacia_id;
                    }
                @endphp
                <form id="formProdutoEstoque" method="POST" action="{{ route('estoque.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 pb-3">
                            <input type="hidden" name="farmacia_id" value="{{ $farmacia_id }}">
                            <label class="mb-2">Designação *</label>
                            <input type="text" id="designacao" class="form-control" placeholder="" name="designacao">
                        </div>
                        <div class="col-md-6 pb-3">
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
                    <div class="" id="repetir_">
                        <div class="" id="item_descartavelq" style="">
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">Caixa *</label>
                                    <input type="number" id="caixa" class="form-control">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Caixinha *</label>
                                    <input type="number" id="caxinha" class="form-control">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Unidade *</label>
                                    <input type="number" id="unidade" class="form-control" onblur="setDescritivo()">
                                </div>
                                <input type="text" id="descritivo" name="descritivo" hidden>
                                <div class="col pb-3">
                                    <label class="mb-2">Total</label>
                                    <input type="number" id="qtd_total_estoque" class="form-control" name="qtd_total" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col pb-3">
                                <label class="mb-2">Lote *</label>
                                <input type="text" class="form-control" name="num_lote"
                                    style="text-transform: uppercase;">
                            </div>
                            <div class="col pb-3">
                                <label class="mb-2">Documento Nº *</label>
                                <input type="text" id="cod_barras" class="form-control" placeholder=""
                                    name="num_documento">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col pb-3">
                                <label class="mb-2">Data Produção *</label>
                                <input type="date" class="form-control" placeholder="" name="data_producao">
                            </div>
                            <div class="col pb-3">
                                <label class="mb-2">Data Expiração *</label>
                                <input type="date" class="form-control" placeholder="" name="data_expiracao">
                            </div>
                            <div class="col pb-3">
                                <label class="mb-2">Data Recepção</label>
                                <input type="date" class="form-control" placeholder="" name="data_recepcao">
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="" id="diverso">
                        <div class="row">
                            <div class="col pb-3">
                                <label class="mb-2">Forma *</label>
                                <input type="text" class="form-control" placeholder="" name="forma">
                            </div>
                            <div class="col pb-3">
                                <label class="mb-2">G. Farmacológico *</label>
                                <select name="grupo_farmaco_id" style="width: 100%" id=""
                                    class="form-control selectr2">
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
                    <div class="row">
                        <div class="col pb-3">
                            <label class="mb-2">Área Hospitalar</label>
                            <select name="area_id" style="width: 100%" id="" class="form-control select2">
                                @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                    @if ($ah->nome == 'Armazém I' or $ah->nome == 'Direcção clínica')
                                        <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col pb-3">
                            <label class="mb-2">OBS</label>
                            <textarea class="form-control" placeholder="" name="obs"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
