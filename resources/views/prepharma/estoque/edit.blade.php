@extends('layout.app')

@section('titulo', 'Editar Estoque')

@section('content')
<div class="content">
    @include('partials.session')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                    <form method="POST" action="{{ route('estoque.update', ['id' => $pe->id, 'returnID' => $returnID]) }}">
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
                                    <option disabled>Selecionar tipo</option>
                                    <option value="descartável" @selected($pe->tipo == 'descartável')>Descartável</option>
                                    <option value="medicamento" @selected($pe->tipo == 'medicamento')>Medicamento</option>
                                    <option value="liquido" @selected($pe->tipo == 'liquido')>Líquido</option>
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
                                    <select class="form-control" name="forma">
                                        <option value="" disabled>Selecione uma forma</option>

                                        <!-- Formas de Administração Oral -->
                                        <optgroup label="Formas de Administração Oral">
                                            <option value="Comprimidos" @selected($pe->forma == 'Comprimidos')>Comprimidos</option>
                                            <option value="Cápsulas" @selected($pe->forma == 'Cápsulas')>Cápsulas</option>
                                            <option value="Tabletes efervescentes" @selected($pe->forma == 'Tabletes efervescentes')>Tabletes efervescentes</option>
                                            <option value="Pó para suspensão oral" @selected($pe->forma == 'Pó para suspensão oral')>Pó para suspensão oral</option>
                                            <option value="Xaropes" @selected($pe->forma == 'Xaropes')>Xaropes</option>
                                            <option value="Soluções orais" @selected($pe->forma == 'Soluções orais')>Soluções orais</option>
                                            <option value="Gomas mastigáveis" @selected($pe->forma == 'Gomas mastigáveis')>Gomas mastigáveis</option>
                                            <option value="Soluções ou elixires" @selected($pe->forma == 'Soluções ou elixires')>Soluções ou elixires</option>
                                        </optgroup>

                                        <!-- Formas de Administração Parenteral -->
                                        <optgroup label="Formas de Administração Parenteral (fora do trato gastrointestinal)">
                                            <option value="Injeções" @selected($pe->forma == 'Injeções')>Injeções</option>
                                            <option value="Infusões intravenosas" @selected($pe->forma == 'Infusões intravenosas')>Infusões intravenosas</option>
                                            <option value="Implantes subcutâneos" @selected($pe->forma == 'Implantes subcutâneos')>Implantes subcutâneos</option>
                                            <option value="Vacinas" @selected($pe->forma == 'Vacinas')>Vacinas</option>
                                            <option value="Pós para solução injetável" @selected($pe->forma == 'Pós para solução injetável')>Pós para solução injetável</option>
                                        </optgroup>

                                        <!-- Formas de Administração Tópica -->
                                        <optgroup label="Formas de Administração Tópica">
                                            <option value="Cremes" @selected($pe->forma == 'Cremes')>Cremes</option>
                                            <option value="Pomadas" @selected($pe->forma == 'Pomadas')>Pomadas</option>
                                            <option value="Géis" @selected($pe->forma == 'Géis')>Géis</option>
                                            <option value="Loções" @selected($pe->forma == 'Loções')>Loções</option>
                                            <option value="Pasta" @selected($pe->forma == 'Pasta')>Pasta</option>
                                            <option value="Sprays tópicos" @selected($pe->forma == 'Sprays tópicos')>Sprays tópicos</option>
                                            <option value="Adesivos transdérmicos" @selected($pe->forma == 'Adesivos transdérmicos')>Adesivos transdérmicos</option>
                                            <option value="Shampoos" @selected($pe->forma == 'Shampoos')>Shampoos</option>
                                            <option value="Sabonetes medicinais" @selected($pe->forma == 'Sabonetes medicinais')>Sabonetes medicinais</option>
                                        </optgroup>

                                        <!-- Outros grupos de opções seguem o mesmo padrão -->
                                        <optgroup label="Outros">
                                            <option value="Descartável" @selected($pe->forma == 'Descartável')>Descartável</option>
                                            <option value="Não Atribuido" @selected($pe->forma == 'Não Atribuido')>Não Atribuido</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">G. Farmacológico *</label>
                                    <select name="grupo_farmaco_id" style="width: 100%" id="grupo_farmaco_id_" class="form-control selectr2">
                                        @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                            <option value="{{ $gf->id }}" @selected($gf->id == $pe->grupo_farmaco_id)>
                                                {{ $gf->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pb-3">
                                    <label class="mb-2">Origem / Destino *</label>
                                    <input type="text" value="{{ $pe->origem_destino }}" class="form-control" placeholder="" name="origem_destino">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Área Hospitalar</label>
                                    <select name="area_id" style="width: 100%" id="area_id_" class="form-control select2">
                                        @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                            @if ($ah->nome == 'Armazém I' or $ah->nome == 'Armazém II' or $ah->nome == 'Direcção clínica')
                                                <option value="{{ $ah->id }}" @selected($ah->id == $pe->estoque->area_hospitalar_id)>{{ $ah->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <div class="col pb-3">
                                        <label class="mb-2">Prateleira</label>
                                        <select name="prateleira_id" style="width: 100%" id="prateleira_id_" class="form-control">
                                            @foreach (\App\Models\Prateleira::all() as $prat)
                                                <option value="{{ $prat->id }}" @selected($prat->id == $pe->prateleira_id)>
                                                    {{ $prat->nome }} [{{ $prat->descricao }}]
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
