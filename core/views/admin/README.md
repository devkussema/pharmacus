# Painel Core Admin

## Este é o painel do diretor Geral/Clínico do Hospital

- Deve ser capaz de ver relatórios e dados estatísticos completos da farmácia

# Rotas

- As rotas estão em core/routes/core_admin.php
- Namespace dedicado em app/Providers/AppServiceProvider.php
- Rotas registradas em app/Providers/RouteServiceProvider.php
- Prefixo de rota: core_admin
- Nome das rotas: core_admin.*
- Middleware: auth, core_admin

# Views

- As views devem estar organizadas e bem moduladas com o layout principal em core/views/admin/layout e todo o resto extende ele
- O layout principal deve ser enxuto, use partials em core/views/admin/partials e inclua no layout
- Use componentes blade para elementos reutilizáveis em core/views/admin/components
- Use diretórios para organizar as views por funcionalidade, ex: core/views/admin/users, core/views/admin/reports, core/views/admin/products, etc

# Controllers

- Os controllers devem estar em app/Http/Controllers/CoreAdmin
- Ao criar as soluções pense sempre em melhores práticas
- Evite lixo no código
- Use serviços para lógicas complexas
- Use repositórios para interagir com o banco de dados
- Use Form Requests para validação
- Use Resources para formatar respostas JSON
- Use Policies para autorização
- Use Jobs para tarefas assíncronas
- Use Events e Listeners para desacoplar funcionalidades

# Design

- O design deve ser simples embora moderno, e muito fácil de usar
- Use cores modernas e fontes do Inter, Apple e etc
- O layout deve ser responsivo e funcionar bem em dispositivos móveis
- A navegação deve ser intuitiva com menus claros e acessíveis
- Use ícones para melhorar a usabilidade
- Use feedback visual para ações do usuário (ex: carregamento, sucesso, erro)
- Use modais para confirmações e formulários rápidos
- Use tabelas com paginação, filtros e ordenação para listas de dados
- Use gráficos para visualização de dados estatísticos
- Use cards para destacar informações importantes
- Use botões claros e chamativos para ações principais
- Use tipografias legíveis e tamanhos adequados para textos
- Use espaçamentos adequados entre elementos para evitar poluição visual
- Use cores contrastantes para destacar elementos importantes
- Use animações sutis para melhorar a experiência do usuário
- Use tooltips para fornecer informações adicionais sem poluir a interface
- Quero modo escuro (dark mode) como opção para o usuário
- Quero tema claro (light mode) como opção para o usuário
- Quero que o usuário possa alternar entre os modos facilmente
- Quero que o sistema lembre a preferência do usuário na próxima visita
- Use uma paleta de cores consistente em todo o painel
- O sidebar deve ser ajustável e com persistência de estado (expandido ou recolhido)
- O header deve conter atalhos para notificações, perfil do usuário e configurações
- O footer deve conter informações de copyright e links úteis
- O header e sidebar devem ser fixos para fácil acesso

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

- Ao desenvolver, nas requisições deves pensar em que a solicitação pode vir por POST ou Ajax, prepare para isso

# Créditos

- Augusto Kussema (dev.kussema@gmail.com)
- Projeto Pharmatina ("https://pharmatina.com")
- Local Dev ("https://pharmacus.me)
- Qui, 23/10/2025 09:22, Talatona, Luanda
