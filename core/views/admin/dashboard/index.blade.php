@extends('core_admin::layout.app')

@section('title','Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <span class="badge bg-light text-dark">Visão geral do sistema</span>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted">Novos pedidos</div>
                <div class="fs-2 fw-semibold">12</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted">Stock crítico</div>
                <div class="fs-2 fw-semibold text-danger">4</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted">Utilizadores</div>
                <div class="fs-2 fw-semibold">58</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted">Farmácias</div>
                <div class="fs-2 fw-semibold">6</div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h4 class="mb-3">Relatórios recentes</h4>
        <div class="card p-3">
            <div id="chartContainer" class="position-relative" style="min-height:260px">
                <div class="skeleton position-absolute w-100 h-100" style="inset:0;border-radius:8px"></div>
                <canvas id="chartPedidos" width="600" height="260" data-lazy-chart="1"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
      // Lazy render do gráfico quando canvas ficar visível
      (function(){
        const canvas=document.getElementById('chartPedidos');
        if(!canvas) return;
        const obs=new IntersectionObserver((entries)=>{
          entries.forEach(e=>{
            if(!e.isIntersecting) return; obs.unobserve(canvas);
            const ctx=canvas.getContext('2d');
            const skeleton=document.querySelector('#chartContainer .skeleton');
            try{
              new Chart(ctx,{ type:'line', data:{ labels:['Jan','Fev','Mar','Abr','Mai','Jun'], datasets:[{ label:'Pedidos', data:[12,19,7,15,22,18], borderColor:'#3b82f6', backgroundColor:'rgba(59,130,246,.2)', tension:.35, fill:true }]}, options:{ plugins:{legend:{display:true}}, scales:{ y:{ beginAtZero:true }}} });
            } finally{ skeleton && (skeleton.style.display='none'); }
          })
        },{threshold:.2});
        obs.observe(canvas);
      })();
    </script>
    @endpush

@endsection
