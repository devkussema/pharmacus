@extends('layout.app')

@section('titulo', 'Adicionar Item')

@section('content')

<div class="content">
    @include('partials.session')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('estoque.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-heading">
                                    <h4>Adicionar Item</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pb-3">
                                    <input type="hidden" id="inp-farmacia_id" name="farmacia_id" value="11a2d86a-c885-44e4-9162-14215ef75b95">
                                    <label class="mb-2">Designação *</label>
                                    <input type="text" id="designacao" value="{{ old('designacao') ?? old('designacao') }}" class="form-control" placeholder="" name="designacao">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Tipo *</label>
                                    <select name="tipo" style="width: 100%" id="tipo_produto_estoque" class="form-control">
                                        <option selected disabled>Selecionar tipo</option>
                                        <option value="descartável">Descartável</option>
                                        <option value="medicamento">Medicamento</option>
                                        <option value="liquido">Liquido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="" id="item_medicamento" style="display:none">
                                <div class="form-row">
                                    {{-- <div class="col pb-3">
                                                <label class="mb-2">Quantidade em Estoque *</label>
                                                <input type="number" class="form-control" placeholder="" name="qtd">
                                            </div> --}}
                                    <div class="col pb-3">
                                        <label class="mb-2">Dosagem *</label>
                                        <input type="text" class="form-control" value="{{ old('dosagem') ?? old('dosagem') }}" placeholder="" name="dosagem">
                                    </div>
                                </div>
                            </div>
                            <div class="" id="repetir_">
                                <div class="" id="item_descartavelq" style="">
                                    <div class="row">
                                        <div class="col pb-3">
                                            <label class="mb-2">Caixa *</label>
                                            <input type="number" name="caixa" value="{{ old('caixa') ?? old('caixa') }}" id="caixa" class="form-control">
                                        </div>
                                        <div class="col pb-3">
                                            <label class="mb-2">Caixinha *</label>
                                            <input type="number" name="caxinha" value="{{ old('caxinha') ?? old('caxinha') }}" id="caxinha" class="form-control">
                                        </div>
                                        <div class="col pb-3">
                                            <label class="mb-2">Unidade *</label>
                                            <input type="number" name="unidade" value="{{ old('unidade') ?? old('unidade') }}" id="unidade" class="form-control" onchange="setQtdDescritivo()" onblur="setDescritivo()">
                                        </div>
                                        <input type="text" id="descritivo" name="descritivo" hidden>
                                        <div class="col pb-3">
                                            <label class="mb-2">Total</label>
                                            <input style="display: none" type="number" id="qtd_total_estoque" value="{{ old('qtd_total') ?? old('qtd_total') }}" class="form-control" name="qtd_total">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Lote *</label>
                                        <input type="text" class="form-control" value="{{ old('num_lote') ?? old('num_lote') }}" name="num_lote"
                                            style="text-transform: uppercase;">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Documento Nº *</label>
                                        <input type="text" id="cod_barras" value="{{ old('num_documento') ?? old('num_documento') }}" class="form-control" placeholder=""
                                            name="num_documento">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Produção *</label>
                                        <input type="date" class="form-control" value="{{ old('data_producao') ?? old('data_producao') }}" name="data_producao">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Expiração *</label>
                                        <input type="date" class="form-control" value="{{ old('data_expiracao') ?? old('data_expiracao') }}" name="data_expiracao">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Recepção</label>
                                        <input type="date" class="form-control" value="{{ old('data_recepcao') ?? old('data_recepcao') }}" name="data_recepcao">
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="" id="diverso">
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Forma *</label>
                                        <input type="text" class="form-control" value="{{ old('forma') ?? old('forma') }}" name="forma">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">G. Farmacológico *</label>
                                        <select name="grupo_farmaco_id" style="width: 100%" id="grupo_farmaco_id_"
                                            class="form-control selectr2">
                                            @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Origem / Destino *</label>
                                        <input type="text" class="form-control" value="{{ old('origem_destino') ?? old('origem_destino') }}" name="origem_destino">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Área Hospitalar</label>
                                    <select name="area_id" style="width: 100%" id="area_id_" class="form-control select2">
                                        @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                            @if ($ah->nome == 'Armazém I' or $ah->nome == 'Direcção clínica')
                                                <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Prateleira</label>
                                    <select name="prateleira_id" style="width: 100%" id="prateleira_id_" class="form-control">
                                        @foreach (\App\Models\Prateleira::all() as $prat)
                                            <option value="{{ $prat->id }}">{{ $prat->nome }} [{{ $prat->descricao }}]</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">OBS</label>
                                    <textarea class="form-control" value="{{ old('obs') ?? old('obs') }}" name="obs"></textarea>
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

<script>
    function setQtdDescritivo() {
        // Obter os valores dos campos
        var caixaValue = document.getElementById('caixa').value;
        var caxinhaValue = document.getElementById('caxinha').value;
        var unidadeValue = document.getElementById('unidade').value;

        // Construir a string descritiva
        var descritivoValue = caixaValue + 'x' + caxinhaValue + 'x' + unidadeValue;

        // Atualizar o valor do campo descritivo
        document.getElementById('descritivo').value = descritivoValue;
    }
</script>
@endsection
