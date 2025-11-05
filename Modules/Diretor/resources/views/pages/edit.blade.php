@extends('diretor::layout.app')

@section('title', 'Editar')

@section('content')
    <div class="container">
        <h1 class="h4">Editar recurso</h1>
        <p class="text-muted">ID: {{ $id ?? '—' }}</p>
    </div>
@endsection
