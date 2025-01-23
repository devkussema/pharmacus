@extends('layout.app')

@section('titulo', 'Gerar Relatório')

@section('content')
    <div class="content">
        @include('partials.session')

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Relatório de Estoque</h5>
                <p class="card-text">Preencha os campos abaixo para gerar o relatório completo de estoque. Certifique-se de fornecer os filtros corretos para obter as informações mais precisas.</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form action="{{ route('gerar_relatorio.post')  }}" name="gerar_relatorio" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Tipo de relatório</label>
                                    <select name="tipo_relatorio" class="form-control">
                                        <option value="estoque">Estoque</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Boa sorte!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Área Hospitalar</label>
                                    <select class="form-control">
                                        @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                            @if ($ah->nome == 'Armazém I' or $ah->nome == 'Armazém II' or $ah->nome == 'Direcção clínica')
                                                <option value="{{ $ah->id }}">{{ $ah->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustomUsername">Forma Farmacéutica</label>
                                    <div class="input-group">
                                        <select class="form-control" name="forma_farmaceutica">
                                            <option value="">Selecione uma forma</option>

                                            <option value="tudo">Tudo</option>

                                            <!-- Formas de Administração Oral -->
                                            <optgroup label="Formas de Administração Oral">
                                                <option value="Comprimidos">Comprimidos</option>
                                                <option value="Cápsulas">Cápsulas</option>
                                                <option value="Tabletes efervescentes">Tabletes efervescentes</option>
                                                <option value="Pó para suspensão oral">Pó para suspensão oral</option>
                                                <option value="Xaropes">Xaropes</option>
                                                <option value="Soluções orais">Soluções orais</option>
                                                <option value="Gomas mastigáveis">Gomas mastigáveis</option>
                                                <option value="Soluções ou elixires">Soluções ou elixires</option>
                                            </optgroup>

                                            <!-- Formas de Administração Parenteral -->
                                            <optgroup label="Formas de Administração Parenteral (fora do trato gastrointestinal)">
                                                <option value="Injeções">Injeções</option>
                                                <option value="Infusões intravenosas">Infusões intravenosas</option>
                                                <option value="Implantes subcutâneos">Implantes subcutâneos</option>
                                                <option value="Vacinas">Vacinas</option>
                                                <option value="Pós para solução injetável">Pós para solução injetável</option>
                                            </optgroup>

                                            <!-- Formas de Administração Tópica -->
                                            <optgroup label="Formas de Administração Tópica">
                                                <option value="Cremes">Cremes</option>
                                                <option value="Pomadas">Pomadas</option>
                                                <option value="Géis">Géis</option>
                                                <option value="Loções">Loções</option>
                                                <option value="Pasta">Pasta</option>
                                                <option value="Sprays tópicos">Sprays tópicos</option>
                                                <option value="Adesivos transdérmicos">Adesivos transdérmicos</option>
                                                <option value="Shampoos">Shampoos</option>
                                                <option value="Sabonetes medicinais">Sabonetes medicinais</option>
                                            </optgroup>

                                            <!-- Formas de Administração Inalatória -->
                                            <optgroup label="Formas de Administração Inalatória">
                                                <option value="Aerossóis">Aerossóis</option>
                                                <option value="Nebulizações">Nebulizações</option>
                                                <option value="Inaladores de pó seco">Inaladores de pó seco</option>
                                            </optgroup>

                                            <!-- Formas de Administração Retal -->
                                            <optgroup label="Formas de Administração Retal">
                                                <option value="Supositórios">Supositórios</option>
                                                <option value="Enemas">Enemas</option>
                                                <option value="Pomadas retal">Pomadas retal</option>
                                            </optgroup>

                                            <!-- Formas de Administração Oftálmica -->
                                            <optgroup label="Formas de Administração Oftálmica">
                                                <option value="Colírios">Colírios</option>
                                                <option value="Pomadas oftálmicas">Pomadas oftálmicas</option>
                                            </optgroup>

                                            <!-- Formas de Administração Nasal -->
                                            <optgroup label="Formas de Administração Nasal">
                                                <option value="Sprays nasais">Sprays nasais</option>
                                                <option value="Gotas nasais">Gotas nasais</option>
                                            </optgroup>

                                            <!-- Formas de Administração Sublingual e Bucal -->
                                            <optgroup label="Formas de Administração Sublingual e Bucal">
                                                <option value="Comprimidos sublinguais">Comprimidos sublinguais</option>
                                                <option value="Tabletes bucais">Tabletes bucais</option>
                                                <option value="Pastilhas">Pastilhas</option>
                                                <option value="Balas medicinais">Balas medicinais</option>
                                            </optgroup>

                                            <!-- Formas de Administração Vaginal -->
                                            <optgroup label="Formas de Administração Vaginal">
                                                <option value="Óvulos vaginais">Óvulos vaginais</option>
                                                <option value="Creme vaginal">Creme vaginal</option>
                                            </optgroup>

                                            <optgroup label="Outros">
                                                <option value="Descartável">Descartável</option>
                                                <option value="Não Atribuido">Não Atribuido</option>
                                            </optgroup>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor escolha uma forma.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Quantidade Máx. Caixa</label>
                                    <input type="number" class="form-control" name="qtd_maxima_caixa" minlength="1" min="1">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Tipo Documento</label>
                                    <select name="tipo_documento" class="form-control">
                                        <option value="estoque">PDF</option>
                                        <option value="word">Word [Em breve]</option>
                                        <option value="excel">Excel [Em breve]</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Escolha um tipo de documento
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value
                                           id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Forneci os filtros corretos para obter as informações mais precisas
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Gerar relatório</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
