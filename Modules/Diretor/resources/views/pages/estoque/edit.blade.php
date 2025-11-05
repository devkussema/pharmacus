@extends('diretor::layout.app')

@section('title', 'Editar Item')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Editar Item de Estoque</h1>
        <p>Atualizar informações do produto #{{ $id }}</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('diretor.estoque.show', $id) }}" class="btn-secondary">
            <i class="fa-solid fa-times me-2"></i>
            Cancelar
        </a>
    </div>
</div>

<div class="page-content">
    <form class="form-container" method="POST" action="{{ route('diretor.estoque.update', $id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-section">
            <h3>Informações Básicas</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome do Produto <span class="required">*</span></label>
                    <input type="text" id="nome" name="nome" class="form-control" value="Paracetamol 500mg" required>
                </div>
                <div class="form-group">
                    <label for="codigo">Código <span class="required">*</span></label>
                    <input type="text" id="codigo" name="codigo" class="form-control" value="PAR-500-001" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="categoria">Categoria <span class="required">*</span></label>
                    <select id="categoria" name="categoria" class="form-control" required>
                        <option value="">Selecione...</option>
                        <option value="analgesicos" selected>Analgésicos</option>
                        <option value="antibioticos">Antibióticos</option>
                        <option value="antialergicos">Antialérgicos</option>
                        <option value="cardiovasculares">Cardiovasculares</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fabricante">Fabricante <span class="required">*</span></label>
                    <input type="text" id="fabricante" name="fabricante" class="form-control" value="PharmaCorp Ltd" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="3">Medicamento analgésico e antipirético para alívio de dores leves a moderadas e redução de febre.</textarea>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Controle de Stock</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="quantidade">Quantidade Atual <span class="required">*</span></label>
                    <input type="number" id="quantidade" name="quantidade" class="form-control" value="245" required>
                </div>
                <div class="form-group">
                    <label for="stock_minimo">Stock Mínimo <span class="required">*</span></label>
                    <input type="number" id="stock_minimo" name="stock_minimo" class="form-control" value="50" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="preco_compra">Preço de Compra (Kz) <span class="required">*</span></label>
                    <input type="number" id="preco_compra" name="preco_compra" class="form-control" value="1200" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="preco_venda">Preço de Venda (Kz) <span class="required">*</span></label>
                    <input type="number" id="preco_venda" name="preco_venda" class="form-control" value="1500" step="0.01" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="validade">Data de Validade <span class="required">*</span></label>
                    <input type="date" id="validade" name="validade" class="form-control" value="2026-06-15" required>
                </div>
                <div class="form-group">
                    <label for="localizacao">Localização</label>
                    <input type="text" id="localizacao" name="localizacao" class="form-control" value="Prateleira A3" placeholder="Ex: Prateleira A3">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Status do Produto</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="status">Status <span class="required">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="normal" selected>Normal</option>
                        <option value="critico">Crítico</option>
                        <option value="expirando">Expirando</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check-wrapper">
                        <input type="checkbox" id="ativo" name="ativo" class="form-check" checked>
                        <label for="ativo">Produto Ativo</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-modern btn-primary">
                <i class="fa-solid fa-save me-2"></i>
                Salvar Alterações
            </button>
            <a href="{{ route('diretor.estoque.show', $id) }}" class="btn-secondary">
                Cancelar
            </a>
        </div>
    </form>
</div>

@push('styles')
<style>
.form-container {
    max-width: 900px;
    margin: 0 auto;
}

.form-section {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-section h3 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1.25rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-primary);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.required {
    color: var(--danger);
}

.form-control {
    padding: 0.625rem 0.875rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: 0.875rem;
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-check-wrapper {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-top: 1.75rem;
}

.form-check {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.form-check-wrapper label {
    margin: 0;
    cursor: pointer;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .form-actions button,
    .form-actions a {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush
@endsection