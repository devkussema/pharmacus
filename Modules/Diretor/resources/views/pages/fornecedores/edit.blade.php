@php
    // Edit view desativada: redirecionar para índice.
    header('Location: ' . route('diretor.fornecedores.index'));
    exit;
@endphp

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