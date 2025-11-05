@extends('diretor::layout.app')

@section('title', 'Visualizar')

@section('content')
    <div class="container">
        <h1 class="h4">Visualizar recurso</h1>
        <p class="text-muted">ID: {{ $id ?? '—' }}</p>
    </div>
@endsection
