<footer class="app-footer">
    <div class="footer-content">
        <div class="footer-left">
            <div class="footer-logo">
                <i class="fa-solid fa-capsules"></i>
                <span>Pharmacus</span>
            </div>
            <div class="footer-text">
                Sistema de gestão farmacêutica profissional
            </div>
        </div>
        
        <div class="footer-center">
            <div class="footer-stats">
                <div class="stat-item">
                    <div class="stat-value">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ date('Y') }}</div>
                    <div class="stat-label">Versão</div>
                </div>
            </div>
        </div>
        
        <div class="footer-right">
            <div class="footer-links">
                <a href="#" class="footer-link">Suporte</a>
                <a href="#" class="footer-link">Documentação</a>
                <a href="#" class="footer-link">API</a>
            </div>
            <div class="footer-copyright">
                &copy; {{ date('Y') }} Pharmacus. Todos os direitos reservados.
            </div>
        </div>
    </div>
</footer>

<style>
.app-footer {
    background: var(--surface);
    border-top: 1px solid var(--border-primary);
    padding: 1.5rem 2rem;
    margin-top: auto;
}

.footer-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.footer-left {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.875rem;
}

.footer-logo i {
    color: var(--primary);
}

.footer-text {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.footer-center {
    flex: 1;
    display: flex;
    justify-content: center;
}

.footer-stats {
    display: flex;
    gap: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.stat-label {
    font-size: 0.625rem;
    color: var(--text-tertiary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.25rem;
}

.footer-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.5rem;
}

.footer-links {
    display: flex;
    gap: 1rem;
}

.footer-link {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.footer-link:hover {
    color: var(--primary);
}

.footer-copyright {
    font-size: 0.625rem;
    color: var(--text-tertiary);
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .footer-right {
        align-items: center;
    }
    
    .footer-center {
        order: -1;
    }
    
    .footer-stats {
        gap: 1rem;
    }
}
</style>
