@extends('diretor::layout.app')

@section('title', 'Novo Fornecedor')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Novo Fornecedor</h1>
        <p>Cadastrar novo parceiro comercial</p>
    </div>
</div>

<div class="page-content">
    <div class="form-container">
        <form>
            <div class="form-section">
                <h3>Dados da Empresa</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome_empresa">Nome da Empresa</label>
                        <input type="text" id="nome_empresa" class="form-control" placeholder="Ex: MedSupply Angola">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Fornecedor</label>
                        <select id="tipo" class="form-control">
                            <option value="">Selecionar tipo</option>
                            <option value="premium">Premium</option>
                            <option value="padrao">Padrão</option>
                            <option value="novo">Novo</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nif">NIF</label>
                        <input type="text" id="nif" class="form-control" placeholder="Número de Identificação Fiscal">
                    </div>
                    <div class="form-group">
                        <label for="especialidade">Especialidade</label>
                        <input type="text" id="especialidade" class="form-control" placeholder="Ex: Medicamentos Gerais">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Contactos</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" class="form-control" placeholder="+244 923 456 789">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="comercial@exemplo.ao">
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <textarea id="endereco" class="form-control" rows="3" placeholder="Endereço completo da empresa"></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-secondary">Cancelar</button>
                <button type="submit" class="btn-primary">Cadastrar Fornecedor</button>
            </div>
        </form>
    </div>
</div>
@endsection