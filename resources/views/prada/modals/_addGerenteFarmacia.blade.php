<div class="modal fade" id="addGerenteFarmacia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar gerente da farmácia</h4>
                    <div class="content create-workform bg-body">
                        <form id="formaddGerenteFarmacia" action="{{ route('gestor.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome_farmacia">Farmácia *</label>
                                <input type="text" name="nome_farmcia" class="form-control" id="nome_farmacia" value=""
                                    placeholder="Nome da farmácia">
                                    <input type="hidden" id="farmacia_id" name="farmacia_id">
                            </div>
                            <div class="form-group">
                                <label for="nome_gestor">Nome do gerente *</label>
                                <input type="text" name="nome" class="form-control" id="nome_gestor" value=""
                                    placeholder="Nome da farmácia">
                            </div>
                            <div class="form-group">
                                <label for="email_gestor">Email *</label>
                                <input type="email" name="email" class="form-control" id="email_gestor" value=""
                                    placeholder="Email do Gestor da farmácia">
                            </div>
                            <div class="form-group">
                                <label for="contato_gestor">Telefone *</label>
                                <input type="text" name="contato" class="form-control" id="contato_gestor" value=""
                                    placeholder="Telefone do Gestor da farmácia">
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>