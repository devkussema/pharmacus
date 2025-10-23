@extends('core_admin::layout.app')
@section('title','Produtos')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Produtos</h1>
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm" id="btnListP" data-loading="A carregar">Lista</button>
            <button class="btn btn-outline-secondary btn-sm" id="btnGridP" data-loading="A carregar">Grelha</button>
        </div>
    </div>

    <div id="productsArea" data-ajax-src="{{ url('/core_admin/api/products') }}" data-type="products">
        @include('core_admin::components/skeleton/table', ['rows'=>8])
    </div>

    @push('scripts')
    <script>
      (function(){
        const area=document.getElementById('productsArea');
        const setView=(view)=>{ area.dataset.view=view; area.setAttribute('data-ajax-src', '{{ url('/core_admin/api/products') }}'); window.coreOverlay.show(); setTimeout(()=>window.coreOverlay.hide(),300); };
        document.getElementById('btnListP')?.addEventListener('click',()=>{ setView('list'); window.location.hash='#plist'; });
        document.getElementById('btnGridP')?.addEventListener('click',()=>{ setView('grid'); window.location.hash='#pgrid'; });
      })();
    </script>
    @endpush

@endsection
