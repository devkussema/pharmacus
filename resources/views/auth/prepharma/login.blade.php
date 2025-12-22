@extends('prepharma_auth::layout.app')

@push('styles')
<style>
    /* Estilos para mensagem de atualização no login */
    .system-updating-card {
        background: #f3f4f6 !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 6px !important;
        padding: 12px 14px !important;
        margin-bottom: 16px !important;
    }

    .system-updating-card::before {
        display: none !important;
    }

    .system-updating-inner {
        display: block !important;
        padding: 0 !important;
        gap: 0 !important;
    }

    .system-updating-icon {
        display: none !important;
    }

    .system-updating-title {
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #1f2937 !important;
        margin: 0 0 4px 0 !important;
        line-height: 1.4 !important;
    }

    .system-updating-dots {
        display: none !important;
    }

    .system-updating-text {
        font-size: 12px !important;
        color: #6b7280 !important;
        margin: 0 !important;
        line-height: 1.4 !important;
    }
</style>
@endpush

@section('content')
<div class="col-lg-6 login-wrap-bg">
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="login-right">
                <div class="login-right-wrap">
                    <div class="account-logo">
                        <a href="javascript:;">
                            <img src="{{ asset('prepharma/img/white__logo2.png') }}" width="48px">
                        </a>
                    </div>
                    <h2>Iniciar Sessão</h2>
                    @include('partials.session')
                    @if (config('app.updating'))
                        <div class="row">
                            <div class="col-12">
                                <div class="update-card-modern" style="background:#ffffff;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.08);padding:12px 16px;display:flex;gap:12px;align-items:center;border:1px solid rgba(2,6,23,0.04);">
                                    <div style="flex:0 0 auto;">
                                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <defs>
                                                <linearGradient id="g1" x1="0" x2="1" y1="0" y2="1">
                                                    <stop offset="0" stop-color="#4f46e5"/>
                                                    <stop offset="1" stop-color="#06b6d4"/>
                                                </linearGradient>
                                            </defs>
                                            <rect width="24" height="24" rx="6" fill="url(#g1)"/>
                                            <path d="M12 7v5" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="12" cy="16.2" r="0.9" fill="#fff"/>
                                        </svg>
                                    </div>
                                    <div style="flex:1;min-width:0;">
                                        <p style="margin:0;font-weight:600;font-size:14px;color:#0f172a;line-height:1.2;">
                                            Sistema em atualização
                                        </p>
                                        <p style="margin:6px 0 0;font-size:13px;color:#475569;line-height:1.35;overflow:hidden;text-overflow:ellipsis;">
                                            Algumas funcionalidades podem ficar instáveis por algum tempo. Agradecemos a sua compreensão.
                                        </p>
                                    </div>
                                    <div style="flex:0 0 auto;text-align:right;">
                                        <span style="display:inline-block;padding:6px 8px;background:rgba(15,23,42,0.04);border-radius:8px;font-size:12px;color:#64748b;">
                                            Em curso
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <p></p><p></p>
                    <div id="login-error" class="alert alert-danger d-none" role="alert"></div>
                    <form id="login-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-block">
                            <label>Email <span class="login-danger">*</span></label>
                            <input class="form-control" type="text" name="email" id="login-email" value="{{ old('email') }}">
                        </div>
                        <div class="input-block">
                            <label>Senha <span class="login-danger">*</span></label>
                            <input class="form-control pass-input" type="password" name="password" id="login-password">
                            <span class="profile-views feather-eye-off toggle-password"></span>
                        </div>
                        <div class="forgotpass">
                            <div class="remember-me">
                                <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
                                    <!-- Remember me
                                    <input type="checkbox" name="radio">
                                    <span class="checkmark"></span> -->
                                </label>
                            </div>
                            {{-- <a href="{{ route('recuperar_senha') }}">Esqueceu a senha?</a> --}}
                        </div>
                        <div class="input-block login-btn">
                            <button class="btn btn-primary btn-block d-inline-flex align-items-center gap-2" type="submit" id="btnLogin">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <span class="btn-text">Login</span>
                            </button>
                        </div>
                    </form>

                    <div class="next-sign">
                        <!-- <p class="account-subtitle">Não tens uma conta? <a href="{{ route('registar') }}">Registar</a></p> -->

                        {{-- <div class="social-login">
                            <a href="javascript:;"><img src="assets/img/icons/login-icon-01.svg"
                                    alt></a>
                            <a href="javascript:;"><img src="assets/img/icons/login-icon-02.svg"
                                    alt></a>
                            <a href="javascript:;"><img src="assets/img/icons/login-icon-03.svg"
                                    alt></a>
                        </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    (function () {
        const form = document.getElementById('login-form');
        if (!form) return;
        const email = document.getElementById('login-email');
        const password = document.getElementById('login-password');
        const btn = document.getElementById('btnLogin');
        const spinner = btn ? btn.querySelector('.spinner-border') : null;
        const btnText = btn ? btn.querySelector('.btn-text') : null;
        const errorBox = document.getElementById('login-error');
        const HOME_URL = "{{ \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/') }}";

        function setLoading(state) {
            if (btn) btn.disabled = state;
            if (email) email.disabled = state;
            if (password) password.disabled = state;
            if (spinner) spinner.classList.toggle('d-none', !state);
            if (btnText) btnText.textContent = state ? 'A entrar...' : 'Login';
        }

        function showError(message) {
            if (!errorBox) return;
            errorBox.textContent = message || 'Ocorreu um erro. Tente novamente.';
            errorBox.classList.remove('d-none');
        }

        function hideError() {
            if (!errorBox) return;
            errorBox.classList.add('d-none');
            errorBox.textContent = '';
        }

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            hideError();
            setLoading(true);
            try {
                const data = new FormData(form); // inclui _token
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    body: data
                });

                // Sucesso esperado pelo controller: 201 + { success: true }
                if (res.status === 201) {
                    // Redireciona para HOME
                    window.location.href = HOME_URL;
                    return;
                }

                // Demais casos: tentar extrair mensagem
                const json = await res.json().catch(() => ({}));
                const msg = (json && json.message) ? json.message : (res.ok ? 'Operação concluída.' : 'Credenciais inválidas, tente novamente');

                if (res.ok) {
                    // Pode ser 200 vindo de alguma lógica distinta: forçar refresh
                    window.location.href = HOME_URL;
                    return;
                }

                showError(msg);
            } catch (err) {
                console.error('Login error:', err);
                showError('Falha de rede. Tente novamente.');
            } finally {
                setLoading(false);
            }
        });
    })();
</script>
@endpush
@endsection
