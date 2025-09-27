Olá {{ $nome_para }},

Foi criada uma conta para si como gestor/gerente de farmácia em {{ config('app.name') }}.

Para activar a sua conta, abra o link abaixo:

{{ $url }}

Palavra-passe temporária: {{ $passwd }}

Se não pediu esta conta, ignore este e-mail.

Atenciosamente,
{{ config('app.name') }}
