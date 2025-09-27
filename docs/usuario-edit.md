# Edição de Usuário via Modal

- Autor: Augusto Kussema
- Data: 2025-09-27

Resumo:
1. Clicar "Editar" abre modal preenchido com os dados do usuário (nome, email, telefone, grupo, status).
2. A senha não é enviada nem alterada neste fluxo.
3. Submissão é feita via AJAX para PATCH /usuario/{id} e o controlador retorna JSON com o usuário actualizado.
4. A lista é atualizada via fetchUsers() (se disponível) ou recarrega a página como fallback.

Notas:
- Requisições AJAX definem o header X-CSRF-TOKEN usando <meta name="csrf-token"> presente na view.
- Testar no ServBay (macOS 12.6.3). Limpar caches se necessário (php artisan view:clear && php artisan route:clear).
- Validadores não permitem alteração da senha neste fluxo (por segurança).
- Testar localmente no ServBay (macOS 12.6.3).
