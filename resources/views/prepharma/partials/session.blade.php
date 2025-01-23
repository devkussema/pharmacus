@php $produtos = getMinimumStock(); @endphp

@if($produtos->count() > 2)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atenção!</strong> Há {{ $produtos->count() }} produtos com menos de 5 caixas.
        <a href="{{ route('alert.show') }}" class="btn btn-link" style="color: #ff0000; font-weight: bold; text-decoration: none; float: right; padding: 0; margin-left: 10px;">
            Ir para a página
        </a>
    </div>
@else
    @foreach ($produtos as $produto)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <a href="/estoque/editar/{{ $produto->id  }}/{{ $produto->estoque->area_hospitalar_id  }}">
                <strong>{{ $produto->designacao  }}!</strong> No <strong>[{{ $produto->estoque->area_hospitalar->nome  }}]</strong> tem apenas {{ getCaixa($produto->descritivo)  }} caixas.
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

{{-- Erros de Validação --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ Auth::user()->nome }}</strong> Por favor, corrija os seguintes erros:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Mensagem de Erro Geral --}}
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ Auth::user()->nome }}</strong> {{ session('error') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Mensagens de Sucesso --}}
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Mensagens de Informação --}}
@if (session()->has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@php
    $e = \App\Models\ConfirmarBaixa::where('area_hospitalar_para', session('id_area_'))->where('confirmado', 0)->get();
@endphp
@if ($e->count() > 0)
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
        Existem produtos que precisas confirmar a entrega
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <a href="{{ route('pedido') }}" class="btn btn-primary">Ver</a>
    </div>
@endif

@php
    $e = \App\Models\PedidoItem::where('area_para', session('id_area_'))->where('confirmado', 0)->get();
@endphp
@if ($e->count() > 0)
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
        Tens {{ $e->count() }} pedidos por atender
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <a href="{{ route('pedido') }}" class="btn btn-primary">Ver</a>
    </div>
@endif

{{-- Mensagens de Aviso --}}
@if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
