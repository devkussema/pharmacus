@extends('layout.app')

@section('titulo', 'Alertas')

@section('content')
    <div class="content">
        @php $produtos = getMinimumStock(); @endphp

        @foreach ($produtos as $produto)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <a href="/estoque/editar/{{ $produto->id  }}/{{ $produto->estoque->area_hospitalar_id  }}">
                    <strong>{{ $produto->designacao  }}!</strong> No <strong>[{{ $produto->estoque->area_hospitalar->nome  }}]</strong> tem apenas {{ getCaixa($produto->descritivo)  }} caixas.
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    </div>
@endsection
