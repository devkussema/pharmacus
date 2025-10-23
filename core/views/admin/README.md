# Painel Core Admin

## Este é o painel do diretor Geral/Clínico do Hospital

- Deve ser capaz de ver relatórios e dados estatísticos completos da farmácia

# Rotas

- As rotas estão em core/routes/core_admin.php
- Namespace dedicado em app/Providers/AppServiceProvider.php
- Rotas registradas em app/Providers/RouteServiceProvider.php

# Views

- As views devem estar organizadas e bem moduladas com o layout principal em core/views/admin/layout e todo o resto extende ele
- O layout principal deve ser enxuto, use partials em core/views/admin/partials e inclua no layout

# Design

- O design deve ser simples embora moderno, e muito fácil de usar
- Use cores modernas e fontes do Inter, Apple e etc

# Recursos

O painel deve ter recursos fundamentais como:
    - Gráficos
    - Exportar para PDF, Excel e CSV
    - Tabelas alimentadas por ajax
    - As páginas de listagem de alguma coisa que tenha tabela devem ter obrigatóriamente a opção de ver em grelha/lista
    - Spinner em todos os btns que fazem envio de requisições
    - Overlay loader durante o carregamento
    - Deve ser sustentado principalmente por ajax

# Desenvolvimento

- Ao desenvolver, nas requisições deves pensar em que a solicitação pode vir por POST ou Ajax, prepare para iso

# Créditos

- Augusto Kussema (dev.kussema@gmail.com)
- Projeto Pharmatina ("https://pharmatina.com")
- Local Dev ("https://pharmacus.me)
- Qui, 23/10/2025 09:22, Talatona, Luanda
