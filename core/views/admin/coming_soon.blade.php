@extends('core_admin::layout.app')
@section('title','Em breve')
@section('content')
    <div class="text-center mt-5">
        <h1>Em breve</h1>
        <p>Esta funcionalidade ainda está em desenvolvimento.</p>
        <a href="{{ route('core_admin.dashboard') }}" class="btn btn-primary">Voltar ao Dashboard</a>
    </div>
@endsection
