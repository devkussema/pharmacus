@extends('diretor::layout.app')

@section('title', 'Editar Fornecedor')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Editar Fornecedor</h1>
        <p>Atualizar informações do fornecedor #{{ $id }}</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('diretor.fornecedores.show', $id) }}" class="btn-secondary">
            <i class="fa-solid fa-times me-2"></i>
            Cancelar
        </a>
    </div>
</div>

<div class="page-content">
    <form class="form-container" method="POST" action="{{ route('diretor.fornecedores.update', $id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-section">
            <h3>Informações da Empresa</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome da Empresa <span class="required">*</span></label>
                    <input type="text" id="nome" name="nome" class="form-control" value="PharmaCorp International" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de Fornecedor <span class="required">*</span></label>
                    <select id="tipo" name="tipo" class="form-control" required>
                        <option value="">Selecione...</option>
                        <option value="premium" selected>Premium</option>
                        <option value="regular">Regular</option>
                        <option value="ocasional">Ocasional</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nif">NIF/CNPJ <span class="required">*</span></label>
                    <input type="text" id="nif" name="nif" class="form-control" value="123456789" required>
                </div>
                <div class="form-group">
                    <label for="prazo_pagamento">Prazo de Pagamento (dias) <span class="required">*</span></label>
                    <input type="number" id="prazo_pagamento" name="prazo_pagamento" class="form-control" value="30" required>
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Contactos</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" value="contato@pharmacorp.com" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone <span class="required">*</span></label>
                    <input type="tel" id="telefone" name="telefone" class="form-control" value="+244 923 456 789" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="telefone_alternativo">Telefone Alternativo</label>
                    <input type="tel" id="telefone_alternativo" name="telefone_alternativo" class="form-control" placeholder="+244 912 345 678">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="website" class="form-control" value="https://www.pharmacorp.com" placeholder="https://">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Endereço</h3>
            <div class="form-group">
                <label for="endereco">Endereço Completo <span class="required">*</span></label>
                <textarea id="endereco" name="endereco" class="form-control" rows="2" required>Rua da Missão, Luanda, Angola</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="cidade">Cidade <span class="required">*</span></label>
                    <input type="text" id="cidade" name="cidade" class="form-control" value="Luanda" required>
                </div>
                <div class="form-group">
                    <label for="provincia">Província <span class="required">*</span></label>
                    <input type="text" id="provincia" name="provincia" class="form-control" value="Luanda" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="pais">País <span class="required">*</span></label>
                    <input type="text" id="pais" name="pais" class="form-control" value="Angola" required>
                </div>
                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" placeholder="Ex: 1000">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Pessoa de Contacto</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="contacto_nome">Nome Completo <span class="required">*</span></label>
                    <input type="text" id="contacto_nome" name="contacto_nome" class="form-control" value="João Silva" required>
                </div>
                <div class="form-group">
                    <label for="contacto_cargo">Cargo <span class="required">*</span></label>
                    <input type="text" id="contacto_cargo" name="contacto_cargo" class="form-control" value="Gerente de Vendas" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="contacto_email">Email <span class="required">*</span></label>
                    <input type="email" id="contacto_email" name="contacto_email" class="form-control" value="joao.silva@pharmacorp.com" required>
                </div>
                <div class="form-group">
                    <label for="contacto_telefone">Telefone <span class="required">*</span></label>
                    <input type="tel" id="contacto_telefone" name="contacto_telefone" class="form-control" value="+244 923 456 789" required>
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Informações Bancárias</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="banco">Banco</label>
                    <input type="text" id="banco" name="banco" class="form-control" value="Banco BIC" placeholder="Nome do banco">
                </div>
                <div class="form-group">
                    <label for="iban">IBAN/Número da Conta</label>
                    <input type="text" id="iban" name="iban" class="form-control" value="AO06004400001234567890123" placeholder="IBAN ou número da conta">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3>Configurações</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="status">Status <span class="required">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="ativo" selected>Ativo</option>
                        <option value="inativo">Inativo</option>
                        <option value="bloqueado">Bloqueado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="avaliacao">Avaliação</label>
                    <select id="avaliacao" name="avaliacao" class="form-control">
                        <option value="">Selecione...</option>
                        <option value="5">⭐⭐⭐⭐⭐ (5.0)</option>
                        <option value="4.5" selected>⭐⭐⭐⭐☆ (4.8)</option>
                        <option value="4">⭐⭐⭐⭐☆ (4.0)</option>
                        <option value="3">⭐⭐⭐☆☆ (3.0)</option>
                        <option value="2">⭐⭐☆☆☆ (2.0)</option>
                        <option value="1">⭐☆☆☆☆ (1.0)</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea id="observacoes" name="observacoes" class="form-control" rows="3" placeholder="Notas internas sobre o fornecedor..."></textarea>
            </div>
            
            <div class="form-check-wrapper">
                <input type="checkbox" id="preferencial" name="preferencial" class="form-check">
                <label for="preferencial">Marcar como Fornecedor Preferencial</label>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-modern btn-primary">
                <i class="fa-solid fa-save me-2"></i>
                Salvar Alterações
            </button>
            <a href="{{ route('diretor.fornecedores.show', $id) }}" class="btn-secondary">
                Cancelar
            </a>
        </div>
    </form>
</div>

@push('styles')
<style>
.form-container {
    max-width: 1000px;
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
    padding-top: 0.75rem;
}

.form-check {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.form-check-wrapper label {
    margin: 0;
    cursor: pointer;
    font-size: 0.875rem;
    color: var(--text-secondary);
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