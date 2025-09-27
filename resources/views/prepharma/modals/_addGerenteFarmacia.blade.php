<div class="modal fade" id="addGerenteFarmacia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar gerente da farmácia</h4>
                    <div class="content create-workform bg-body">
                        <form id="formaddGerenteFarmacia" action="{{ route('gestor.store') }}" method="POST" onsubmit="return window.handleAddGerente ? window.handleAddGerente(event) : false;">
                            @csrf
                            <div id="formAddGerenteErrors" class="mb-2"></div>
                            <div class="form-group">
                                <label for="nome_farmacia">Farmácia *</label>
                                <input type="text" name="nome_farmcia" class="form-control" id="nome_farmacia" value=""
                                    placeholder="Nome da farmácia" readonly>
                                    <input type="hidden" id="farmacia_id" name="farmacia_id">
                            </div>
                            <div class="form-group">
                                <label for="nome_gestor">Nome do gerente *</label>
                                <input type="text" name="nome" class="form-control" id="nome_gestor" value=""
                                    placeholder="Nome do gerente" required>
                            </div>
                            <div class="form-group">
                                <label for="email_gestor">Email *</label>
                                <input type="email" name="email" class="form-control" id="email_gestor" value=""
                                    placeholder="Email do Gestor da farmácia" required>
                            </div>
                            <div class="form-group">
                                <label for="contato_gestor">Telefone *</label>
                                <input type="text" name="contato" class="form-control" id="contato_gestor" value=""
                                    placeholder="Telefone do Gestor da farmácia" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>

                        <script>
                            (function(){
                                try{
                                    const form = document.getElementById('formaddGerenteFarmacia');
                                    const errorsContainer = document.getElementById('formAddGerenteErrors');

                                    function clearErrors(){
                                        if (!errorsContainer) return; errorsContainer.innerHTML='';
                                        form && form.querySelectorAll('.is-invalid').forEach(i=>i.classList.remove('is-invalid'));
                                    }
                                    function showErrors(errors){
                                        clearErrors(); if (!errorsContainer) return; const ul = document.createElement('ul'); ul.className='alert alert-danger small';
                                        for(const k in errors){ if (!Object.prototype.hasOwnProperty.call(errors,k)) continue; errors[k].forEach(m=>{ const li=document.createElement('li'); li.textContent=m; ul.appendChild(li); const f=form.querySelector('[name="'+k+'"]'); if (f) f.classList.add('is-invalid'); }); }
                                        errorsContainer.appendChild(ul);
                                    }

                                    // core submit logic extracted so we can call it from onsubmit or event listener
                                    window.handleAddGerente = function(e){
                                        if (e && e.preventDefault) e.preventDefault();
                                        if (!form) return false;
                                        clearErrors();
                                        const btn = form.querySelector('button[type="submit"]'); const orig = btn?btn.innerHTML:null; if (btn){ btn.disabled=true; btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'; }

                                        const action = form.getAttribute('action') || window.location.href; const method = (form.getAttribute('method')||'POST').toUpperCase(); const fd = new FormData(form);

                                        fetch(action, { method: method, body: fd, credentials: 'same-origin', headers: {'X-Requested-With':'XMLHttpRequest','Accept':'application/json'} })
                                        .then(async res=>{ const ct = res.headers.get('content-type')||''; let data={}; if (ct.indexOf('application/json')>-1) data=await res.json(); else data.text=await res.text();
                                            if (res.ok){
                                                try{ const m = document.getElementById('addGerenteFarmacia'); if (typeof bootstrap !== 'undefined') bootstrap.Modal.getOrCreateInstance(m).hide(); else jQuery('#addGerenteFarmacia').modal('hide'); }catch(e){}
                                                const msg = (data && data.message)?data.message:'Gerente adicionado com sucesso';
                                                const sm = document.getElementById('modalGerenteSuccess');
                                                if (sm){ sm.querySelector('.modal-body p').textContent = msg; try{ bootstrap.Modal.getOrCreateInstance(sm).show(); }catch(e){ alert(msg); } }
                                                setTimeout(()=>{ location.reload(); }, 1000);
                                            } else if (res.status===422){ showErrors((data && data.errors)?data.errors:{'error':['Dados inválidos']}); }
                                            else { showErrors({'error': [ (data && data.message)?data.message:(data.text||'Erro') ]}); }
                                        }).catch(err=>{ console.error('Erro envio gerente', err); showErrors({'error':[err.message||'Erro de rede']}); })
                                        .finally(()=>{ if (btn){ btn.disabled=false; try{ btn.innerHTML = orig; }catch(e){} } });

                                        return false;
                                    };

                                    // also attach as event listener for progressive enhancement
                                    if (form) form.addEventListener('submit', window.handleAddGerente);
                                }catch(err){ console.error('init formaddGerenteFarmacia', err); }
                            })();
                        </script>

                        <!-- Success modal for Gerente -->
                        <div class="modal fade" id="modalGerenteSuccess" tabindex="-1" aria-hidden="true">
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
