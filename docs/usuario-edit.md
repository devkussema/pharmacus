# Edição de Usuário via Modal

- Autor: Augusto Kussema
- Data: 2025-09-27

Resumo:
1. Ao clicar em "Editar" na lista de usuários abre-se um modal com os campos: nome, email, telefone, grupo e status (não edita senha).
2. O formulário é submetido via AJAX (fetch) para a rota PATCH `/usuario/{id}`.
3. O controlador valida os dados e devolve JSON com o usuário actualizado.
4. A view principal (lista) consome o JSON e actualiza a tabela (função fetchUsers), ou recarrega a página como fallback.

Notas de implementação:
- Requisições AJAX usam o header `X-CSRF-TOKEN` obtido de `<meta name="csrf-token">`.
- O User model expõe `perfil_url` e `foto_perfil_url` para uso em JS.
- Validadores não permitem alteração da senha neste fluxo (por segurança).
- Testar localmente no ServBay (macOS 12.6.3).
