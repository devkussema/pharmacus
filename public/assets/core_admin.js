// Core Admin JS (public)
(()=>{
  const body=document.body;
  const sidebar=document.getElementById('coreSidebar');
  const overlay=document.getElementById('coreOverlay');
  const toggleSidebarBtn=document.getElementById('toggleSidebar');
  const toggleDarkBtn=document.getElementById('toggleDarkBtn');

  // Dark mode persistence
  const darkKey='core_admin_dark_mode';
  if(localStorage.getItem(darkKey)==='1'){ body.classList.add('dark-mode'); }
  toggleDarkBtn?.addEventListener('click',()=>{
    body.classList.toggle('dark-mode');
    localStorage.setItem(darkKey, body.classList.contains('dark-mode') ? '1' : '0');
  });

  // Sidebar persistence (collapsed)
  const sideKey='core_admin_sidebar_collapsed';
  if(localStorage.getItem(sideKey)==='1') body.classList.add('sidebar-collapsed');
  toggleSidebarBtn?.addEventListener('click',()=>{
    body.classList.toggle('sidebar-collapsed');
    localStorage.setItem(sideKey, body.classList.contains('sidebar-collapsed') ? '1' : '0');
  });

  // Overlay helpers
  window.coreOverlay={show(){ overlay&&(overlay.style.display='flex'); }, hide(){ overlay&&(overlay.style.display='none'); }};

  // Fetch helper com overlay e headers padrão JSON
  window.coreFetch=async (url,opts={})=>{
    try{
      window.coreOverlay.show();
      const res=await fetch(url,{ headers:{'Accept':'application/json', ...(opts.headers||{})}, ...opts });
      // tenta json, se falhar devolve texto
      const text=await res.text();
      try{ return JSON.parse(text); }catch{ return text; }
    }finally{ window.coreOverlay.hide(); }
  };

  // Button loading states
  document.addEventListener('click',e=>{
    const btn=e.target.closest('[data-loading]');
    if(!btn) return;
    const original=btn.innerHTML;
    btn.disabled=true; btn.dataset._original=original;
    btn.innerHTML='<span class="spinner-border spinner-border-sm me-2"></span>'+ (btn.dataset.loading || 'Processando...');
    setTimeout(()=>{ // auto-reverte em 6s se nada reverter
      if(btn.disabled){ btn.disabled=false; btn.innerHTML=btn.dataset._original || original; }
    },6000);
  });

  // Lazy load por IntersectionObserver
  const io=new IntersectionObserver((entries)=>{
    entries.forEach(async (entry)=>{
      if(!entry.isIntersecting) return;
      const el=entry.target; io.unobserve(el);
      const src=el.getAttribute('data-ajax-src');
      if(!src) return;
      try{
        const before=el.innerHTML;
        // skeleton já deve estar no HTML; apenas busca e substitui
        const data=await window.coreFetch(src);
        if(Array.isArray(data)){
          // tabela simples se el pede tabela
          if(el.dataset.type==='users'){
            const rows=data.map(u=>`<tr><td>${u.id}</td><td>${u.name}</td><td>${u.email}</td></tr>`).join('');
            el.innerHTML=`<table class="table table-striped"><thead><tr><th>ID</th><th>Nome</th><th>Email</th></tr></thead><tbody>${rows}</tbody></table>`;
          } else if(el.dataset.type==='products'){
            const rows=data.map(p=>`<tr><td>${p.id}</td><td>${p.designacao}</td><td>${p.qtd ?? ''}</td></tr>`).join('');
            el.innerHTML=`<table class="table table-striped"><thead><tr><th>ID</th><th>Designação</th><th>Qtd</th></tr></thead><tbody>${rows}</tbody></table>`;
          } else if(el.dataset.view==='grid'){
            const cards=data.map(item=>`<div class="col-md-3"><div class="card p-3 h-100"><h6>${item.name||item.designacao}</h6><small class="text-muted">ID: ${item.id}</small></div></div>`).join('');
            el.innerHTML=`<div class="row g-3">${cards}</div>`;
          } else {
            el.innerHTML=`<pre class="p-3 bg-light border rounded">${JSON.stringify(data,null,2)}</pre>`;
          }
        } else if(typeof data==='string'){
          el.innerHTML=data;
        } else {
          el.innerHTML=`<pre class="p-3 bg-light border rounded">${JSON.stringify(data,null,2)}</pre>`;
        }
      }catch(err){
        el.innerHTML='<div class="alert alert-danger">Falha ao carregar dados</div>';
      }
    });
  },{threshold:.15});

  document.querySelectorAll('[data-ajax-src]').forEach(el=>io.observe(el));

})();
