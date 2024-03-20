<div class="modal fade" id="addPermissoes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar Permissões</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddPermissoesq" action="{{ route('permissoes.store') }}" method="POST">
                            @csrf
                            <input type="text" name="user_id" id="user_id_" value="{{ auth()->user()->id  }}">
                            <div class="header-title">
                                <h4 class="card-title">Produtos</h4>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="produtos[cadastrar]" type="checkbox" class="custom-control-input" id="cadastrar_prod">
                                    <label class="custom-control-label" for="cadastrar_prod">Cadastrar</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="produtos[dar_baixa]" type="checkbox" class="custom-control-input" id="dar_baixa_prod">
                                    <label class="custom-control-label" for="dar_baixa_prod">Dar Baixa</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="produtos[ver]" type="checkbox" class="custom-control-input" id="ver_prod">
                                    <label class="custom-control-label" for="ver_prod">Ver</label>
                                </div>
                            </div>

                            <div class="header-title">
                                <h4 class="card-title">Áreas Hospitalares</h4>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="area_hospitalar[cadastrar]" type="checkbox" class="custom-control-input" id="cadastrar_ah">
                                    <label class="custom-control-label" for="cadastrar_ah">Cadastrar</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="area_hospitalar[editar]" type="checkbox" class="custom-control-input" id="editar_ah">
                                    <label class="custom-control-label" for="editar_ah">Editar</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="area_hospitalar[ver]" type="checkbox" class="custom-control-input" id="ver_ah">
                                    <label class="custom-control-label" for="ver_ah">Ver</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="area_hospitalar[desativar]" type="checkbox" class="custom-control-input" id="desativar_ah">
                                    <label class="custom-control-label" for="desativar_ah">Desativar</label>
                                </div>
                            </div>

                            <div class="header-title">
                                <h4 class="card-title">Relatórios</h4>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="relatorio[ver]" type="checkbox" class="custom-control-input" id="ver_relatorio">
                                    <label class="custom-control-label" for="ver_relatorio">Ver</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
