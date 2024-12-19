@extends('layout.app')

@section('titulo', 'Adicionar Prateleira')

@section('content')
<div class="content">
    @include('partials.session')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('prateleira.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-heading">
                                    <h4>Adicionar Prateleira</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pb-3">
                                    <input type="hidden" id="inp-farmacia_id" name="farmacia_id" value="11a2d86a-c885-44e4-9162-14215ef75b95">
                                    <label class="mb-2">Designação *</label>
                                    <input type="text" id="designacao" value="{{ old('designacao') ?? old('designacao') }}" class="form-control" placeholder="" name="designacao">
                                </div>
                                {{-- <div class="col-md-6 pb-3">
                                    <label class="mb-2">Localização *</label>
                                    <select required name="localização" style="width: 100%" id="tipo_produto_estoque" class="form-control">
                                        <option selected disabled>Selecionar tipo</option>
                                        <option value="descartável">Descartável</option>
                                        <option value="medicamento">Medicamento</option>
                                        <option value="liquido">Liquido</option>
                                    </select>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">Descrição</label>
                                    <textarea class="form-control" value="{{ old('descricao') ?? old('descricao') }}" name="descricao"></textarea>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
