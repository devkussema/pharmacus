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
                                <input type="text" class="form-control" placeholder="Nome da área" name="nome">
                            </div>
                            <div class="pb-3">
                                <label class="mb-2">Descrição (opcional)</label>
                                <textarea class="form-control" placeholder="Descrição da área" name="descricao"></textarea>
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

<div class="modal fade" id="editar_area_hospitalar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3" id="nome_area">Área Hospitalar</h4>
                    <div class="content create-workform bg-body">
                        <form id="formEditarAH" method="POST" action="{{ route('a_h.index.store') }}">
                            @csrf
                            <div class="pb-3">
                                <label class="mb-2">Nome *</label>
                                <input type="text" class="form-control" id="nome" placeholder="Nome da área" name="nome">
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
