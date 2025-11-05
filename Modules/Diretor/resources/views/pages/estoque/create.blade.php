@extends('diretor::layout.app')

@section('title', 'Criar Item de Estoque')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Criar Item de Estoque</h1>
        <p>Adicionar novo produto ao inventário</p>
    </div>
</div>

<div class="page-content">
    <div class="form-container">
        <form>
            <div class="form-section">
                <h3>Informações Básicas</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome do Produto</label>
                        <input type="text" id="nome" class="form-control" placeholder="Ex: Paracetamol 500mg">
                    </div>
                    <div class="form-group">
                        <label for="codigo">Código do Produto</label>
                        <input type="text" id="codigo" class="form-control" placeholder="Ex: PAR-500-001">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" class="form-control">
                            <option value="">Selecionar categoria</option>
                            <option value="analgesicos">Analgésicos</option>
                            <option value="antibioticos">Antibióticos</option>
                            <option value="vitaminas">Vitaminas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fabricante">Fabricante</label>
                        <input type="text" id="fabricante" class="form-control" placeholder="Nome do fabricante">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Controle de Stock</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="quantidade">Quantidade Inicial</label>
                        <input type="number" id="quantidade" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label for="minimo">Stock Mínimo</label>
                        <input type="number" id="minimo" class="form-control" placeholder="0">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-secondary">Cancelar</button>
                <button type="submit" class="btn-primary">Criar Produto</button>
            </div>
        </form>
    </div>
</div>
@endsection