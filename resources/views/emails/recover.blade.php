<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha - {{ env('APP_NAME', 'Pharmatina') }}</title>
    <style>
        body { background:#f3f5f7; margin:0; padding:0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
        .container { max-width:600px; margin:0 auto; background:#ffffff; border-radius:6px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,0.06); }
        .header { padding:24px; text-align:center; color:#3e8ef7; font-weight:600; font-size:20px; }
        .body { padding:24px 28px; color:#444; font-size:15px; line-height:1.6; }
        .btn { display:inline-block; padding:12px 28px; background:#3e8ef7; color:#fff !important; text-decoration:none; border-radius:4px; border:1px solid #3e8ef7; }
        .muted { color:#888; font-size:13px; text-align:center; padding:0 28px 24px; }
    </style>
</head>
<body>
    <div style="padding:24px">
        <div class="container">
            <div class="header">{{ env('APP_NAME', 'Pharmatina') }}</div>
            <div class="body">
                <p>Olá <strong>{{ $nome }}</strong>,</p>
                <p>Recebemos um pedido para redefinir sua senha. Caso tenha solicitado, clique no botão abaixo para continuar o processo.</p>
                <p style="text-align:center; margin:28px 0;">
                    <a class="btn" href="{{ $url }}" target="_blank">Redefinir senha</a>
                </p>
                <p>Se você não solicitou esta ação, pode ignorar este e-mail com segurança.</p>
            </div>
            <div class="muted">Atenciosamente,<br>A Equipa {{ env('APP_NAME', 'Pharmatina') }}</div>
        </div>
    </div>
</body>
</html>
