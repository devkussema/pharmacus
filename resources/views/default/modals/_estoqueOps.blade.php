<div class="modal fade" id="estoqueOps" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Dar Baixa</h4>
                    <div class="content create-workform bg-body">
                        <form id="formBaixaEstoque" action="{{ route('estoque.baixa') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="endereco">Área *</label>
                                <input type="hidden" name="user_id" id="user_id">
                                <select name="area_hospitalar_id" id="" class="form-control">
                                    @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                        @if ($ah->isGerente and $ah->id != auth()->user()->area_hospitalar->area_hospitalar_id)
                                            <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="produto_id" id="id_produto">
                                <label for="qtd_">Quantidade a transferir</label>
                                <input type="number" name="qtd" class="form-control" id="qtd_"
                                    placeholder="Quantidade a transferir" min="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>