@extends('diretor::layout.app')

@section('title', 'Meu Perfil')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Meu Perfil</h1>
        <p>Gerencie suas informações pessoais e preferências</p>
    </div>
</div>

<div class="page-content">
    <div class="profile-layout">
        <div class="profile-main">
            <!-- Card de Perfil com Foto -->
            <div class="card profile-card">
                <div class="profile-header-section">
                    <img src="https://ui-avatars.com/api/?name=Diretor&background=2563eb&color=fff&size=120" alt="Foto do Perfil" class="profile-photo-large">
                    <div class="profile-header-info">
                        <h2>Dr. António Manuel Silva</h2>
                        <p class="profile-role-large">Diretor da Farmácia Hospitalar</p>
                        <p class="profile-license">CRF 12345-AO</p>
                        <button class="btn-modern btn-secondary mt-2">
                            <i class="fa-solid fa-camera me-2"></i>
                            Alterar Foto
                        </button>
                    </div>
                </div>
            </div>

            <!-- Informações Pessoais -->
            <div class="card">
            <div class="card-header">
                    <h3>Informações Pessoais</h3>
                </div>
                <div class="card-body">
                    <form class="profile-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" class="form-control" value="Dr. António Manuel Silva" placeholder="Seu nome completo">
                        </div>
                        <div class="form-group">
                            <label>Cargo</label>
                            <input type="text" class="form-control" value="Diretor da Farmácia Hospitalar" placeholder="Seu cargo" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>E-mail Institucional</label>
                            <input type="email" class="form-control" value="antonio.silva@pharmacus.ao" placeholder="email@exemplo.com">
                        </div>
                        <div class="form-group">
                            <label>E-mail Pessoal</label>
                            <input type="email" class="form-control" value="antonio.silva@email.com" placeholder="email@pessoal.com">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Telefone Principal</label>
                            <input type="tel" class="form-control" value="+244 923 456 789" placeholder="+244 900 000 000">
                        </div>
                        <div class="form-group">
                            <label>Telefone Alternativo</label>
                            <input type="tel" class="form-control" value="+244 912 345 678" placeholder="+244 900 000 000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Registro Profissional</label>
                        <input type="text" class="form-control" value="CRF 12345-AO" placeholder="CRF" readonly>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-modern btn-secondary">Cancelar</button>
                        <button type="submit" class="btn-modern btn-primary">
                            <i class="fa-solid fa-save me-2"></i>
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Segurança e Senha -->
        <div class="card">
            <div class="card-header">
                <h3>Segurança da Conta</h3>
            </div>
            <div class="card-body">
                <form class="security-form">
                    <div class="form-group">
                        <label>Senha Atual</label>
                        <div class="password-input">
                            <input type="password" class="form-control" placeholder="Digite sua senha atual">
                            <button type="button" class="toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nova Senha</label>
                        <div class="password-input">
                            <input type="password" class="form-control" placeholder="Digite sua nova senha">
                            <button type="button" class="toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-hint">Mínimo 8 caracteres, incluindo maiúsculas e números</small>
                    </div>

                    <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                        <div class="password-input">
                            <input type="password" class="form-control" placeholder="Confirme sua nova senha">
                            <button type="button" class="toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-modern btn-primary">
                            <i class="fa-solid fa-key me-2"></i>
                            Alterar Senha
                        </button>
                    </div>
                </form>

                <div class="security-options">
                    <h4>Autenticação de Dois Fatores</h4>
                    <p>Adicione uma camada extra de segurança à sua conta</p>
                    <button class="btn-modern btn-secondary">
                        <i class="fa-solid fa-shield-halved me-2"></i>
                        Configurar 2FA
                    </button>
                </div>
            </div>
        </div>

        <!-- Preferências -->
        <div class="card">
            <div class="card-header">
                <h3>Preferências</h3>
            </div>
            <div class="card-body">
                <div class="preference-item">
                    <div class="preference-info">
                        <h4>Tema</h4>
                        <p>Escolha entre modo claro ou escuro</p>
                    </div>
                    <select class="preference-select">
                        <option value="auto">Automático (Sistema)</option>
                        <option value="light">Claro</option>
                        <option value="dark" selected>Escuro</option>
                    </select>
                </div>

                <div class="preference-item">
                    <div class="preference-info">
                        <h4>Notificações por E-mail</h4>
                        <p>Receba atualizações importantes por e-mail</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="preference-item">
                    <div class="preference-info">
                        <h4>Alertas de Estoque Baixo</h4>
                        <p>Notificações quando medicamentos atingirem nível mínimo</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="preference-item">
                    <div class="preference-info">
                        <h4>Relatórios Semanais</h4>
                        <p>Receba resumo semanal de atividades</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Atividade Recente -->
        <div class="card">
            <div class="card-header">
                <h3>Atividade Recente</h3>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </div>
                        <div class="activity-content">
                            <p>Login realizado</p>
                            <span>Hoje às 08:30 - IP: 192.168.1.45</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div class="activity-content">
                            <p>Senha alterada</p>
                            <span>02/11/2025 às 14:22</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="activity-content">
                            <p>Perfil atualizado</p>
                            <span>28/10/2025 às 10:15</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.profile-layout {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.profile-card {
    background: linear-gradient(135deg, var(--primary) 0%, #1d4ed8 100%);
    border: none;
    color: white;
}

.profile-header-section {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}

.profile-photo-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.profile-header-info h2 {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    color: white;
}

.profile-role-large {
    font-size: 1.125rem;
    margin: 0 0 0.25rem 0;
    opacity: 0.9;
}

.profile-license {
    font-size: 0.875rem;
    font-family: 'JetBrains Mono', monospace;
    opacity: 0.8;
    margin: 0;
}

.mt-2 {
    margin-top: 0.5rem;
}

.my-4 {
    margin: 2rem 0;
}

.profile-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.profile-main > .profile-card {
    grid-column: 1 / -1;
}

@media (max-width: 1024px) {
    .profile-main {
        grid-template-columns: 1fr;
    }
}

.profile-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

@media (max-width: 1024px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
}

.profile-photo-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    padding-bottom: 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
}

.profile-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid var(--primary);
}

.btn-change-photo {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-size: 0.875rem;
    cursor: pointer;
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-change-photo:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.profile-form,
.security-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.form-control {
    padding: 0.75rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.9375rem;
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    background: var(--surface);
}

.form-control:read-only {
    background: var(--bg-tertiary);
    color: var(--text-tertiary);
    cursor: not-allowed;
}

.password-input {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    width: 32px;
    height: 32px;
    border: none;
    background: none;
    color: var(--text-tertiary);
    cursor: pointer;
    transition: color var(--transition-fast);
}

.toggle-password:hover {
    color: var(--primary);
}

.form-hint {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
}

.security-options {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-primary);
}

.security-options h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.security-options p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 1rem 0;
}

.preference-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 0;
    border-bottom: 1px solid var(--border-primary);
}

.preference-item:last-child {
    border-bottom: none;
}

.preference-info h4 {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.preference-info p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.preference-select {
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.875rem;
    cursor: pointer;
}

.toggle-switch {
    position: relative;
    width: 48px;
    height: 28px;
    cursor: pointer;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--bg-tertiary);
    border-radius: 28px;
    transition: background var(--transition-fast);
}

.toggle-slider:before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    left: 4px;
    bottom: 4px;
    background: white;
    border-radius: 50%;
    transition: transform var(--transition-fast);
}

.toggle-switch input:checked + .toggle-slider {
    background: var(--primary);
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(20px);
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--border-radius-sm);
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.activity-content p {
    font-size: 0.9375rem;
    font-weight: 500;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.activity-content span {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}
</style>
@endpush
