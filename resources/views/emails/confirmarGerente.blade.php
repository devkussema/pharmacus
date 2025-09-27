<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Confirmação de Gerente</title>
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color: #333; }
    .container { max-width: 600px; margin: 0 auto; padding: 24px; }
    .brand { background: #6b5bdb; color: #fff; padding: 12px; border-radius: 6px; text-align: center; }
    .card { border: 1px solid #eee; padding: 18px; border-radius: 6px; margin-top: 18px; }
    .btn { display:inline-block; padding:10px 16px; background:#2b6cb0; color:#fff; text-decoration:none; border-radius:6px }
    .muted { color:#666; font-size:14px }
  </style>
</head>
<body>
  <div class="container">
    <div class="brand">
      <strong>{{ config('app.name', 'Aplicação') }}</strong>
    </div>

    <div class="card">
      <h3>Olá {{ $nome_para }},</h3>
      <p>Foi criada uma conta para si como gestor/gerente de farmácia em {{ config('app.name') }}. Para activar a sua conta e definir a palavra-passe temporária, por favor clique no botão abaixo:</p>

      <p style="text-align:center; margin:20px 0">
        <a class="btn" href="{{ $url }}">Confirmar Conta</a>
      </p>

      <p class="muted">Palavra-passe temporária: <strong>{{ $passwd }}</strong></p>

      <hr>
      <p class="muted">Se não pediu esta conta, ignore este e-mail.</p>
      <p class="muted">Atenciosamente,<br>{{ config('app.name') }} Team</p>
    </div>
  </div>
</body>
</html>
