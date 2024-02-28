<div class="modal fade" id="modalAddProdutoEstoque" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar Produto</h4>
                    <div class="content create-workform bg-body">
                        <form id="formProdutoEstoque" method="POST" action="{{ route('estoque.store') }}">
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
                                        <option value="descartavel">Descartável</option>
                                        <option value="medicamento">Medicamento</option>
                                        <option value="liquido">Liquido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row" id="item_descartavel">
                                <div class="col pb-3">
                                    <label class="mb-2">Descritivo *</label>
                                    <input type="text" id="descritivo" class="form-control mask" oninput="addQtdTotal(this)" data-mask="99x99x99" placeholder="" name="descritivo">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Total em unidades</label>
                                    <input type="number" id="qtd_total_estoque" disabled class="form-control" name="qtd">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Quantidade em Estoque *</label>
                                    <input type="number" class="form-control" placeholder="" name="qtd">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Dosagem *</label>
                                    <input type="text" class="form-control" placeholder="" name="dosagem">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Forma *</label>
                                    <input type="text" class="form-control" placeholder="" name="forma">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Grupo Farmacológico *</label>
                                    <select name="grupo_farmaco_id" style="width: 100%" id="" class="form-control select2">
                                        @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                            <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Origem / Destino *</label>
                                    <input type="text" class="form-control" placeholder="" name="origem_destino">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Lote *</label>
                                    <input type="text" class="form-control" placeholder="" name="num_lote">
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
                            <div class="form-row">
                                <div class="col pb-3">
                                    <label class="mb-2">Documento Nº *</label>
                                    <input type="number" id="cod_barras" class="form-control" placeholder="" name="num_documento">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Quantidade Embalagem</label>
                                    <input type="number" class="form-control" placeholder="" name="qtd_embalagem">
                                </div>
                            </div>
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
