@extends('prepharma_auth::layout.app')

@section('content')
<div class="col-lg-6 login-wrap-bg">
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="login-right">
                <div class="login-right-wrap">
                    <div class="account-logo">
                        <a href="index.html"><img src="assets/img/login-logo.png" alt></a>
                    </div>
                    <h2>Iniciar Sessão</h2>
                    @include('partials.session')
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
                            <a href="{{ route('recuperar_senha') }}">Esqueceu a senha?</a>
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

                        <div class="social-login">
                            <a href="javascript:;"><img src="assets/img/icons/login-icon-01.svg"
                                    alt></a>
                            <a href="javascript:;"><img src="assets/img/icons/login-icon-02.svg"
                                    alt></a>
                            <a href="javascript:;"><img src="assets/img/icons/login-icon-03.svg"
                                    alt></a>
                        </div>

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
