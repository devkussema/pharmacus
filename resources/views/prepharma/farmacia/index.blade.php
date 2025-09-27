@extends('prepharma.layout.app')

@section('titulo', 'Farmácias')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}">Áreas Hospitalares</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todas</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('partials.session')

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Farmácias</h3>
                                        <div class="doctor-search-blk mt-2">
                                            <div class="top-nav-search table-search-blk">
                                                <form id="form_search" method="POST">
                                                    <input type="text" id="search-table"
                                                        class="form-control outline-success" placeholder="Procure aqui">
                                                    <a class="btn">
                                                        <img src="{{ assetr('assets/img/icons/search-normal.svg') }}" alt>
                                                    </a>
                                                </form>
                                            </div>
                                            {{-- Botão para abrir modal de cadastrar farmácia --}}
                                                <button type="button"
                                                    class="btn btn-primary btn-sm ms-2 d-inline-flex align-items-center"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalCadastrarFarmacia"
                                                    title="Cadastrar Farmácia"
                                                    aria-label="Cadastrar Farmácia">
                                                    <i class="ri-add-line me-1"></i>
                                                    Cadastrar Farmácia
                                                </button>

                                                <!-- Modal: Cadastrar Farmácia (prepharma theme) -->
                                                <div class="modal fade" id="modalCadastrarFarmacia" tabindex="-1" aria-labelledby="modalCadastrarFarmaciaLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content border-0 shadow-sm">
                                                            <div class="modal-body p-4">
                                                                <div class="popup text-left">
                                                                    <h4 class="mb-3">Adicionar farmácia</h4>
                                                                    <div class="content create-workform bg-body p-3 rounded">
                                                                        <form id="formAddFarmacia" action="{{ route('farmacia.store') }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-md-6">
                                                                                    <label for="nome_farmacia_modal" class="form-label">Nome *</label>
                                                                                    <input type="text" name="nome" id="nome_farmacia_modal" class="form-control" required>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="categoria_farmacia_modal" class="form-label">Tipo de Farmácia *</label>
                                                                                    <select name="categoria_id" id="categoria_farmacia_modal" class="form-select">
                                                                                        @php $cats = \App\Models\Categoria::where('tipo', 'farmacia')->get(); @endphp
                                                                                        @foreach ($cats as $categoria)
                                                                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="logotipo_farmacia_modal" class="form-label">Logotipo</label>
                                                                                    <input class="form-control" type="file" id="logotipo_farmacia_modal" name="logotipo" accept="image/*">
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="codigo_farmacia_modal" class="form-label">Código</label>
                                                                                    <input type="text" name="codigo" id="codigo_farmacia_modal" class="form-control">
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <label for="endereco_farmacia_modal" class="form-label">Endereço *</label>
                                                                                    <input type="text" name="endereco" id="endereco_farmacia_modal" class="form-control" required>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <label for="descricao_farmacia_modal" class="form-label">Descrição</label>
                                                                                    <textarea name="obs" id="descricao_farmacia_modal" class="form-control" rows="3"></textarea>
                                                                                    <input type="hidden" name="descricao" id="descricao_hidden" value="">
                                                                                </div>
                                                                            </div>

                                                                            <div class="d-flex justify-content-end mt-4">
                                                                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Fechar</button>
                                                                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                                                                            </div>
                                                                        </form>
                                                                        <div id="formAddFarmaciaErrors" class="mb-2"></div>
                                                                        <script>
                                                                            (function(){
                                                                                try{
                                                                                    const form = document.getElementById('formAddFarmacia');
                                                                                    if (!form) return console.warn('formAddFarmacia not found');

                                                                                    const modalEl = document.getElementById('modalCadastrarFarmacia');
                                                                                    let bsModal = null;
                                                                                    try{
                                                                                        if (typeof bootstrap !== 'undefined' && modalEl){
                                                                                            bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                                                                                        }
                                                                                    }catch(e){
                                                                                        console.warn('bootstrap modal instance not available', e);
                                                                                        bsModal = null;
                                                                                    }

                                                                                    const errorsContainer = document.getElementById('formAddFarmaciaErrors');

                                                                                    function clearErrors(){
                                                                                        if (!errorsContainer) return;
                                                                                        errorsContainer.innerHTML = '';
                                                                                        const invalids = form.querySelectorAll('.is-invalid');
                                                                                        invalids.forEach(i => i.classList.remove('is-invalid'));
                                                                                    }

                                                                                    function showErrors(errors){
                                                                                        clearErrors();
                                                                                        if (!errorsContainer) return;
                                                                                        const ul = document.createElement('ul');
                                                                                        ul.className = 'alert alert-danger small';
                                                                                        for (const key in errors){
                                                                                            if (!Object.prototype.hasOwnProperty.call(errors, key)) continue;
                                                                                            const msgs = errors[key];
                                                                                            msgs.forEach(m => {
                                                                                                const li = document.createElement('li');
                                                                                                li.textContent = m;
                                                                                                ul.appendChild(li);
                                                                                                // try to mark the related field invalid
                                                                                                const field = form.querySelector('[name="' + key + '"]');
                                                                                                if (field) field.classList.add('is-invalid');
                                                                                            });
                                                                                        }
                                                                                        errorsContainer.appendChild(ul);
                                                                                    }

                                                                                    form.addEventListener('submit', function(e){
                                                                                        e.preventDefault();
                                                                                        clearErrors();

                                                                                        // copy descricao to hidden
                                                                                        const txt = document.getElementById('descricao_farmacia_modal');
                                                                                        const hidden = document.getElementById('descricao_hidden');
                                                                                        if (txt && hidden) hidden.value = txt.value;

                                                                                        const submitBtn = form.querySelector('button[type="submit"]');
                                                                                        const originalBtnHtml = submitBtn ? submitBtn.innerHTML : null;
                                                                                        if (submitBtn){
                                                                                            submitBtn.disabled = true;
                                                                                            try{ submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'; }catch(e){}
                                                                                        }

                                                                                        const action = form.getAttribute('action') || window.location.href;
                                                                                        const method = (form.getAttribute('method') || 'POST').toUpperCase();
                                                                                        const formData = new FormData(form);

                                                                                        fetch(action, {
                                                                                            method: method,
                                                                                            body: formData,
                                                                                            credentials: 'same-origin',
                                                                                            headers: {
                                                                                                'X-Requested-With': 'XMLHttpRequest',
                                                                                                'Accept': 'application/json'
                                                                                            }
                                                                                        }).then(async res => {
                                                                                            const contentType = res.headers.get('content-type') || '';
                                                                                            let data = {};
                                                                                            if (contentType.indexOf('application/json') > -1) data = await res.json();
                                                                                            else data.text = await res.text();

                                                                                            if (res.ok){
                                                                                                // success flow
                                                                                                try{ if (bsModal) bsModal.hide(); }catch(e){}
                                                                                                const successMsg = (data && data.message) ? data.message : 'Farmácia cadastrada com sucesso.';
                                                                                                const successModalEl = document.getElementById('modalFarmaciaSuccess');
                                                                                                if (successModalEl){
                                                                                                    try{ successModalEl.querySelector('.modal-body p').textContent = successMsg; }catch(e){}
                                                                                                    try{ const sm = (typeof bootstrap !== 'undefined') ? bootstrap.Modal.getOrCreateInstance(successModalEl) : null; sm && sm.show(); }catch(e){ alert(successMsg); }
                                                                                                } else {
                                                                                                    alert(successMsg);
                                                                                                }

                                                                                                // optional: reload page after short delay so table updates
                                                                                                setTimeout(function(){
                                                                                                    try{
                                                                                                        if (window.jQuery && window.jQuery.fn && window.jQuery.fn.DataTable){
                                                                                                            try{ window.jQuery('#table-p').DataTable().ajax && window.jQuery('#table-p').DataTable().ajax.reload(); }catch(e){ location.reload(); }
                                                                                                        } else {
                                                                                                            location.reload();
                                                                                                        }
                                                                                                    }catch(e){ location.reload(); }
                                                                                                }, 1200);
                                                                                            } else if (res.status === 422){
                                                                                                // validation errors
                                                                                                showErrors((data && data.errors) ? data.errors : {'error': ['Dados inválidos']});
                                                                                            } else {
                                                                                                // other errors
                                                                                                const msg = (data && data.message) ? data.message : (data.text || 'Ocorreu um erro inesperado');
                                                                                                showErrors({'error': [msg]});
                                                                                            }
                                                                                        }).catch(err => {
                                                                                            console.error('fetch error', err);
                                                                                            showErrors({'error': [err.message || 'Erro de rede']});
                                                                                        }).finally(() => {
                                                                                            if (submitBtn){
                                                                                                submitBtn.disabled = false;
                                                                                                try{ submitBtn.innerHTML = originalBtnHtml; }catch(e){}
                                                                                            }
                                                                                        });
                                                                                    });
                                                                                }catch(err){
                                                                                    console.error('formAddFarmacia init error', err);
                                                                                }
                                                                            })();
                                                                        </script>

                                                                        <!-- Success modal shown after AJAX submit -->
                                                                        <div class="modal fade" id="modalFarmaciaSuccess" tabindex="-1" aria-hidden="true">
                                                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body text-center p-4">
                                                                                        <div class="mb-3">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#20c997" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                                                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0z"/>
                                                                                                <path d="M10.97 5.97a.235.235 0 0 0-.02-.022L7.477 9.42 5.383 7.33a.75.75 0 0 0-1.06 1.06l2.5 2.5a.75.75 0 0 0 1.079-.02l3.5-4a.75.75 0 0 0-1.02-1.1z"/>
                                                                                            </svg>
                                                                                        </div>
                                                                                        <h5>Sucesso</h5>
                                                                                        <p class="small text-muted">Operação concluída com sucesso.</p>
                                                                                        <div class="mt-3">
                                                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @include('estoque.modalAddProduto')
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" id="imprimir-pagina" target="_blank" class=" me-2">
                                    <img src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt>
                                </a>
                                <a href="javascript:;" class=" me-2"><img
                                        src="{{ assetr('assets/img/icons/pdf-icon-02.svg') }}" alt></a>
                                <a href="javascript:;" class=" me-2"><img
                                        src="{{ assetr('assets/img/icons/pdf-icon-03.svg') }}" alt></a>
                                <a href="javascript:;" id="alert"><img
                                        src="{{ assetr('assets/img/icons/pdf-icon-04.svg') }}" alt></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0 table-prateleiras"
                            id="table-p">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Código</th>
                                    <th>Status</th>
                                    <th>Gerente</th>
                                    <th>Categoria</th>
                                    <th>Endereço</th>
                                    <th>OBS</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($farmacias as $farmacia)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    {{ $farmacia->nome }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $farmacia->codigo }}</td>
                                        <td>
                                            @if ($farmacia->status)
                                                Ativa
                                            @else
                                                Inativa
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$farmacia->gerente)
                                                Não definido
                                            @else
                                                {{ $farmacia->gerente->user->nome }}
                                            @endif
                                        </td>
                                        <td>{{ @$farmacia->categoria->nome }}</td>
                                        <td>{{ $farmacia->endereco }}</td>
                                        <td>{{ $farmacia->obs }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a href="{{ route('farmacia.show', ['farmacia' => $farmacia->id]) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                    style="width:36px; height:36px; padding:0;" title="Ver {{ $farmacia->nome }}"
                                                    aria-label="Ver {{ $farmacia->nome }}">
                                                    <i class="ri-eye-line"></i>
                                                    <span class="visually-hidden">Ver</span>
                                                </a>

                                                <button type="button"
                                                    class="btn btn-sm btn-success rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="getDataFarma('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')"
                                                    data-toggle="tooltip" data-bs-toggle="tooltip"
                                                    title="Editar {{ $farmacia->nome }}"
                                                    aria-label="Editar {{ $farmacia->nome }}">
                                                    <i class="ri-pencil-line"></i>
                                                    <span class="visually-hidden">Editar</span>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-info rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="preencherModalComFarmacia('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')"
                                                    data-toggle="tooltip" data-bs-toggle="tooltip"
                                                    title="Adicionar gerente {{ $farmacia->nome }}"
                                                    aria-label="Adicionar gerente {{ $farmacia->nome }}">
                                                    <i class="ri-bubble-chart-line"></i>
                                                    <span class="visually-hidden">Adicionar gerente</span>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-danger rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="modalEliminarFarmacia('{{ $farmacia->id }}')"
                                                    data-toggle="tooltip" data-bs-toggle="tooltip"
                                                    title="Eliminar {{ $farmacia->nome }}"
                                                    aria-label="Eliminar {{ $farmacia->nome }}">
                                                    <i class="ri-delete-bin-line"></i>
                                                    <span class="visually-hidden">Eliminar</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('prepharma.modals._viewFarmacia')
    @include('prepharma.modals._addGerenteFarmacia')
    @include('prepharma.modals._editarFarmacia')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, scripts ready');
        });

        function visualizarFarmacia(id) {
            console.log('Clicou para ver farmácia ID:', id);

            var url = '/farmacia/get/' + id;
            console.log('URL da requisição:', url);

            jQuery.get(url)
                .done(function(data) {
                    console.log('Dados recebidos:', data);

                    // Preencher logo
                    var logoSrc = "{{ assetr('assets/img/icons/pharmacy-default.svg') }}";
                    if (data.logo) {
                        logoSrc = "{{ url('storage') }}/" + data.logo;
                    }
                    jQuery('#modalViewFarmacia #view_logo').attr('src', logoSrc);

                    // Preencher dados básicos
                    jQuery('#modalViewFarmacia #view_nome').text(data.nome || 'Sem nome');
                    jQuery('#modalViewFarmacia #view_codigo').text(data.codigo || 'Sem código');

                    // Status com badge
                    var statusHtml = data.status ?
                        '<span class="badge bg-success">Ativa</span>' :
                        '<span class="badge bg-danger">Inativa</span>';
                    jQuery('#modalViewFarmacia #view_status').html(statusHtml);

                    // Gerente
                    var gerenteText = '-';
                    if (data.gerente && data.gerente.user) {
                        gerenteText = data.gerente.user.nome;
                    }
                    jQuery('#modalViewFarmacia #view_gerente').text(gerenteText);

                    // Categoria
                    jQuery('#modalViewFarmacia #view_categoria').text(data.categoria ? data.categoria.nome : '-');

                    // Outros campos
                    jQuery('#modalViewFarmacia #view_endereco').text(data.endereco || '-');
                    jQuery('#modalViewFarmacia #view_obs').text(data.obs || '-');
                    jQuery('#modalViewFarmacia #view_descricao').text(data.descricao || '-');

                    // Botão editar
                    jQuery('#modalViewFarmacia #view_editar_btn').attr('href', '/farmacia/' + id + '/edit');

                    // Mostrar modal
                    jQuery('#modalViewFarmacia').modal('show');
                })
                .fail(function(xhr, status, error) {
                    console.error('Erro na requisição:', {
                        status: status,
                        error: error,
                        responseText: xhr.responseText
                    });
                    alert('Erro ao obter dados da farmácia: ' + error);
                });
        }

        function preencherModalComFarmacia(url) {
            jQuery.get(url)
                .done(function(data) {
                    jQuery('#farmacia_id').val(data.id);
                    jQuery('#nome_farmacia').val(data.nome);
                    jQuery('#addGerenteFarmacia').modal('show');
                })
                .fail(function() {
                    alert('Erro ao carregar dados para gerente');
                });
        }

        function modalEliminarFarmacia(id) {
            jQuery('#deleteFormFarmacia').attr('action', '/farmacia/apagar/' + id);
            jQuery('#texto-aviso').text('Tem certeza que deseja eliminar esta farmácia?');
            jQuery('#modalEliminarFarmacia').modal('show');
        }

        function getDataFarma(url) {
            console.log('getDataFarma requesting', url);
            fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                .then(async res => {
                    const ct = res.headers.get('content-type') || '';
                    let data = {};
                    if (ct.indexOf('application/json') > -1) data = await res.json();
                    else data.text = await res.text();
                    if (!res.ok) throw new Error((data && data.message) ? data.message : 'Erro ao obter dados');

                    console.log('getDataFarma response', data);
                    // populate edit form fields
                    jQuery('#id_farmacia').val(data.id || data.ID || '');
                    jQuery('#nome_farmacia').val(data.nome || data.name || '');
                    jQuery('#endereco').val(data.endereco || data.address || '');
                    jQuery('#descricao').val(data.descricao || data.descricao || data.obs || '');
                    // try set categoria if exists
                    if (data.categoria_id){
                        const cat = document.querySelector('#formEditFarmacia select[name="categoria_id"]');
                        if (cat) cat.value = data.categoria_id;
                    }

                    // set form action to the update route for this farmacia
                    var form = document.getElementById('formEditFarmacia');
                    if (form){
                        form.setAttribute('action', '/farmacia/' + (data.id || ''));
                        // ensure method override input exists
                        if (!form.querySelector('input[name="_method"]')){
                            var m = document.createElement('input'); m.type='hidden'; m.name='_method'; m.value='PUT'; form.appendChild(m);
                        }
                    }

                    // show bootstrap modal
                    try{
                        var m = document.getElementById('modalEditarFarmacia');
                        if (typeof bootstrap !== 'undefined') bootstrap.Modal.getOrCreateInstance(m).show();
                        else jQuery('#modalEditarFarmacia').modal('show');
                    }catch(e){ console.warn('could not show modal', e); }
                })
                .catch(err => {
                    console.error('getDataFarma error', err);
                    alert('Erro ao carregar dados para edição: ' + (err.message || err));
                });
        }

        // AJAX submit for edit form to avoid redirect
        (function(){
            try{
                const formEdit = document.getElementById('formEditFarmacia');
                if (!formEdit) return;

                const errorsContainerEdit = document.createElement('div');
                errorsContainerEdit.id = 'formEditFarmaciaErrors';
                formEdit.parentNode.insertBefore(errorsContainerEdit, formEdit);

                function clearErrorsEdit(){
                    errorsContainerEdit.innerHTML = '';
                    formEdit.querySelectorAll('.is-invalid').forEach(i=>i.classList.remove('is-invalid'));
                }

                function showErrorsEdit(errors){
                    clearErrorsEdit();
                    const ul = document.createElement('ul'); ul.className='alert alert-danger small';
                    for (const k in errors){ if (!Object.prototype.hasOwnProperty.call(errors,k)) continue; errors[k].forEach(m=>{ const li=document.createElement('li'); li.textContent=m; ul.appendChild(li); const f=formEdit.querySelector('[name="'+k+'"]'); if(f) f.classList.add('is-invalid'); }) }
                    errorsContainerEdit.appendChild(ul);
                }

                formEdit.addEventListener('submit', function(e){
                    e.preventDefault();
                    clearErrorsEdit();
                    const submitBtn = formEdit.querySelector('button[type="submit"]');
                    const orig = submitBtn ? submitBtn.innerHTML : null;
                    if (submitBtn){ submitBtn.disabled=true; submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvando...'; }

                    const action = formEdit.getAttribute('action') || window.location.href;
                    const method = (formEdit.getAttribute('method') || 'POST').toUpperCase();
                    const fd = new FormData(formEdit);

                    fetch(action, { method: method, body: fd, credentials: 'same-origin', headers: {'X-Requested-With':'XMLHttpRequest','Accept':'application/json'} })
                        .then(async res=>{
                            const ct = res.headers.get('content-type')||''; let data={}; if (ct.indexOf('application/json')>-1) data = await res.json(); else data.text = await res.text();
                            if (res.ok){
                                try{ if (typeof bootstrap !== 'undefined') { bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditarFarmacia')).hide(); } }
                                catch(e){}
                                const msg = data.message || 'Actualizado com sucesso';
                                const successModal = document.getElementById('modalFarmaciaSuccess');
                                if (successModal){ successModal.querySelector('.modal-body p').textContent = msg; try{ bootstrap.Modal.getOrCreateInstance(successModal).show(); }catch(e){ alert(msg); } }
                                setTimeout(()=>{ location.reload(); }, 900);
                            } else if (res.status === 422){ showErrorsEdit((data && data.errors) ? data.errors : {'error':['Dados inválidos']}); }
                            else { showErrorsEdit({'error': [ (data && data.message) ? data.message : (data.text || 'Erro') ]}); }
                        }).catch(err=>{ console.error('edit submit error',err); showErrorsEdit({'error':[err.message||'Erro de rede']}); })
                        .finally(()=>{ if (submitBtn){ submitBtn.disabled=false; submitBtn.innerHTML = orig; } });
                });
            }catch(e){ console.error('init edit form handler error', e); }
        })();
    </script>

@endsection
