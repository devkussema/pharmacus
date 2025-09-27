<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bem-vindo</title>
</head>
<body style="font-family: sans-serif; color: #333;">
  <div style="max-width:600px; margin:0 auto; padding:20px;">
    <h2>Olá, {{ $nomeUser }}</h2>
    <p>Recebemos a solicitação de criação de conta. Para ativar a sua conta, por favor clique no botão abaixo:</p>
    <p style="text-align:center; margin: 30px 0;">
      <a href="{{ $url_ativacao }}" style="background:#4b56d2;color:#fff;padding:12px 20px;border-radius:6px;text-decoration:none;">Ativar Conta</a>
    </p>
    <p>Se não solicitou esta conta, ignore este email.</p>
    <hr>
    <p style="font-size:12px;color:#777;">{{ env('APP_NAME') }} - Suporte</p>
  </div>
</body>
</html>
