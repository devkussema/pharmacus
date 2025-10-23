<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('titulo', config('app.name'))</title>
    <style>
        /* Estilos mínimos para a página de autenticação */
        body{font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background:#f6f7fb; margin:0;}
        .auth-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
        .auth-card{max-width:980px;width:100%;background:#fff;border-radius:10px;box-shadow:0 8px 24px rgba(15,23,42,0.06);overflow:hidden}
        .auth-card .auth-body{display:flex;flex-wrap:wrap}
        .auth-left{flex:1 1 60%;padding:32px}
        .auth-right{flex:1 1 40%;background:linear-gradient(180deg,#f9fafb,#fff);display:flex;align-items:center;justify-content:center;padding:16px}
        .avatar-80{width:80px;height:80px;border-radius:50%;object-fit:cover}
        .btn{display:inline-block;padding:10px 16px;border-radius:6px;background:#3b82f6;color:#fff;border:none;cursor:pointer}
        .btn-primary{background:#3b82f6}
        .form-control{display:block;width:100%;padding:10px;border:1px solid #d1d5db;border-radius:6px}
        .floating-label{position:relative}
    </style>
</head>
<body>
    <main class="auth-wrap">
        <div class="auth-card" role="main">
            <div class="auth-body">
                <div class="auth-left">
                    @yield('conteudo')
                </div>
                <div class="auth-right">
                    {{-- Espaço para imagem ilustrativa --}}
                    <img src="{{ asset('prepharma/images/login/01.png') }}" alt="login-image" style="max-width:240px;opacity:.9">
                </div>
            </div>
        </div>
    </main>
</body>
</html>
