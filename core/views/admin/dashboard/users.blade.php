@extends('core_admin::layout.app')
@section('title','Utilizadores')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Utilizadores</h1>
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm" id="btnList" data-loading="A carregar">Lista</button>
            <button class="btn btn-outline-secondary btn-sm" id="btnGrid" data-loading="A carregar">Grelha</button>
        </div>
    </div>

    <div id="usersArea" data-ajax-src="{{ url('/core_admin/api/users') }}" data-type="users">
        @include('core_admin::components/skeleton/table', ['rows'=>8])
    </div>

    @push('scripts')
    <script>
      (function(){
        const area=document.getElementById('usersArea');
        const setView=(view)=>{ area.dataset.view=view; area.setAttribute('data-ajax-src', '{{ url('/core_admin/api/users') }}'); window.coreOverlay.show(); setTimeout(()=>window.coreOverlay.hide(),300); };
        document.getElementById('btnList')?.addEventListener('click',()=>{ setView('list'); window.location.hash='#list'; });
        document.getElementById('btnGrid')?.addEventListener('click',()=>{ setView('grid'); window.location.hash='#grid'; });
      })();
    </script>
    @endpush

@endsection
