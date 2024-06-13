@extends('layout.app')

@section('titulo', 'Editar Estoque')

@section('content')
<div class="content">
    @include('partials.session')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}">Áreas Hospitalares</a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Ver todas</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('estoque.update', ['id' => $pe->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-heading">
                                    <h4>Editar {{ $pe->designacao }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6 pb-3">
                                {{-- <input type="hidden" id="inp-farmacia_id" name="farmacia_id" value="{{ $farmacia_id }}"> --}}
                                <label class="mb-2">Designação *</label>
                                <input type="hidden" name="returnID" value="{{ $returnID }}">
                                <input type="text" id="designacao" class="form-control" value="{{ $pe->designacao }}" placeholder="" name="designacao">
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
                                    <input type="text" class="form-control" value="{{ $pe->dosagem }}" placeholder="" name="dosagem">
                                </div>
                            </div>
                        </div>
                        <div class="" id="repetir_">
                            <div class="" id="item_descartavelq" style="">
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Caixa *</label>
                                        <input type="number" name="caixa" value="{{ getCaixa($pe->descritivo) }}" id="caixa" class="form-control">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Caixinha *</label>
                                        <input type="number" name="caxinha" value="{{ getCaixinha($pe->descritivo) }}" id="caxinha" class="form-control">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Unidade *</label>
                                        <input type="number" name="unidade" id="unidade" value="{{ getUnit($pe->descritivo) }}" class="form-control" onblur="setDescritivo()">
                                    </div>
                                    <input type="text" id="descritivo" name="descritivo" hidden>
                                    <div class="col pb-3">
                                        <label class="mb-2">Total</label>
                                        <input type="number" id="qtd_total_estoque" class="form-control" name="qtd_total"
                                            disabled="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">Lote *</label>
                                    <input type="text" class="form-control" value="{{ $pe->num_lote }}" name="num_lote"
                                        style="text-transform: uppercase;">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Documento Nº *</label>
                                    <input type="text" id="cod_barras" value="{{ $pe->num_documento }}" class="form-control" placeholder=""
                                        name="num_documento">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">Data Produção *</label>
                                    <input type="date" class="form-control" value="{{ $pe->data_producao }}" placeholder="" name="data_producao">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Data Expiração *</label>
                                    <input type="date" class="form-control" value="{{ $pe->data_expiracao }}" placeholder="" name="data_expiracao">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Data Recepção</label>
                                    <input type="date" class="form-control" placeholder="" name="data_recepcao">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="" id="diverso">
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">Forma *</label>
                                    <input type="text" class="form-control" value="{{ $pe->forma }}" placeholder="" name="forma">
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">G. Farmacológico *</label>
                                    <select name="grupo_farmaco_id" style="width: 100%" id="grupo_farmaco_id_"
                                        class="form-control selectr2">
                                        @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                            @if ($gf->id == $pe->grupo_farmaco_id)
                                                <option selected value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                            @else
                                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Origem / Destino *</label>
                                    <input type="text" value="{{ $pe->origem_destino }}" class="form-control" placeholder="" name="origem_destino">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col pb-3">
                                <label class="mb-2">Área Hospitalar</label>
                                <select name="area_id" style="width: 100%" id="area_id_" class="form-control select2">
                                    @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                        @if ($ah->id == $pe->estoque->area_hospitalar->id)
                                            <option selected value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                        @else
                                            <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col pb-3">
                                <label class="mb-2">OBS</label>
                                <textarea class="form-control" placeholder="Opcional" name="obs"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="doctor-submit text-end">
                                <button type="submit" class="btn btn-primary submit-form me-2">
                                    Atualizar
                                </button>
                                <button type="button" class="btn btn-primary cancel-form">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection