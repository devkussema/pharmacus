# Sistema de Registro de Atividades - Fornecedores

## 📋 Visão Geral

Sistema completo de auditoria e rastreamento de atividades implementado para o módulo de fornecedores.

## 🎯 Funcionalidades Implementadas

### 1. **AtividadeService** (`app/Services/AtividadeService.php`)
Serviço centralizado para registro de atividades com métodos especializados:

- `registar()` - Método genérico para registar qualquer atividade
- `registarCriacao()` - Registra criação de fornecedores
- `registarAtualizacao()` - Registra atualizações com detalhes das mudanças
- `registarExclusao()` - Registra exclusões (soft delete)
- `registarVisualizacao()` - Registra quando alguém visualiza detalhes
- `registarListagem()` - Registra consultas e filtros aplicados

### 2. **Mensagens Elaboradas**
Todas as atividades geram mensagens descritivas e contextualizadas:

#### Exemplos de Mensagens:
- **Criação**: `"Criou um novo Fornecedor: Farmácia Central"`
- **Atualização**: `"Atualizou o Fornecedor 'Farmácia Central'. Campos alterados: email, telefone, status"`
- **Exclusão**: `"Excluiu o Fornecedor: Farmácia Central"`
- **Visualização**: `"Visualizou os detalhes do Fornecedor: Farmácia Central"`
- **Listagem**: `"Listou 15 Fornecedores com filtros aplicados (tipo: 'nacional', status: 'ativo')"`

### 3. **Metadados Capturados**
Cada atividade registra automaticamente:

```php
[
    'user_id' => ID do utilizador,
    'user_name' => Nome do utilizador,
    'texto' => Mensagem descritiva,
    'action' => 'create|update|delete|view|list',
    'model_type' => Classe do modelo,
    'model_id' => ID do registo,
    'changes' => Array com mudanças (antes → depois),
    'snapshot_before' => Estado antes da alteração,
    'snapshot_after' => Estado depois da alteração,
    'ip_address' => IP do utilizador,
    'route' => Rota acessada,
    'http_method' => Método HTTP,
    'correlation_id' => UUID para rastreamento,
    'level' => 'info|warning|error',
    'sensitive' => Boolean para dados sensíveis,
    'actor_role' => Papel do utilizador
]
```

### 4. **Endpoint de Histórico**
Nova rota API: `GET /api/fornecedores/{id}/historico`

Retorna todas as atividades relacionadas a um fornecedor específico, ordenadas por data (mais recente primeiro).

### 5. **Interface de Histórico** (`_historicoFornecedor.blade.php`)
Offcanvas moderno com timeline visual:

- **Timeline com cores por tipo de ação**:
  - 🟢 Verde: Criação
  - 🔵 Azul: Atualização
  - 🔴 Vermelho: Exclusão
  - 🟡 Amarelo: Visualização
  - 🟣 Roxo: Listagem

- **Informações exibidas**:
  - Badge do tipo de ação
  - Texto descritivo da atividade
  - Utilizador que executou
  - Papel/role do utilizador
  - Data/hora relativa (ex: "Há 2 horas")
  - Detalhes das mudanças (antes → depois)

- **Recursos visuais**:
  - Animações suaves ao passar o mouse
  - Estados vazios informativos
  - Formatação automática de datas
  - Destaque visual das mudanças (verde para novo, vermelho riscado para antigo)

## 🔧 Integração no Controller

### FornecedorController - Métodos Atualizados:

```php
// Listagem (com filtros)
public function listar(Request $request)
{
    // ... lógica de filtros ...
    
    AtividadeService::registarListagem(
        'Fornecedor',
        $filtrosAplicados,
        $fornecedores->count()
    );
}

// Visualização
public function show($id)
{
    // ... buscar fornecedor ...
    
    AtividadeService::registarVisualizacao('Fornecedor', $fornecedor);
}

// Criação
public function store(Request $request)
{
    // ... validação e criação ...
    
    AtividadeService::registarCriacao('Fornecedor', $fornecedor);
}

// Atualização
public function update(Request $request, $id)
{
    // Captura mudanças antes de atualizar
    $dadosOriginais = $fornecedor->getOriginal();
    $dadosNovos = $request->all();
    $mudancas = [];

    foreach ($dadosNovos as $campo => $valorNovo) {
        $valorAntigo = $dadosOriginais[$campo] ?? null;
        if ($valorAntigo != $valorNovo) {
            $mudancas[$campo] = [
                'antigo' => $valorAntigo,
                'novo' => $valorNovo
            ];
        }
    }

    $fornecedor->update($request->all());

    if (!empty($mudancas)) {
        AtividadeService::registarAtualizacao('Fornecedor', $fornecedor, $mudancas);
    }
}

// Exclusão
public function destroy($id)
{
    // ... buscar fornecedor ...
    
    // Registra ANTES de deletar para preservar dados
    AtividadeService::registarExclusao('Fornecedor', $fornecedor);
    
    $fornecedor->delete();
}

// Histórico (novo método)
public function historico($id)
{
    $atividades = Atividade::where('model_type', Fornecedor::class)
        ->where('model_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json(['data' => $atividades]);
}
```

## 📊 Exemplo de Dados Registrados

### Criação de Fornecedor:
```json
{
  "user_id": 1,
  "user_name": "Augusto Kussema",
  "texto": "Criou um novo Fornecedor: Distribuidora Médica Angola",
  "action": "create",
  "model_type": "App\\Models\\Fornecedor",
  "model_id": "uuid-fornecedor",
  "snapshot_after": {
    "nome": "Distribuidora Médica Angola",
    "nif": "123456789",
    "tipo": "nacional",
    "status": "ativo"
  },
  "ip_address": "192.168.1.100",
  "route": "api/fornecedores",
  "http_method": "POST",
  "level": "info",
  "actor_role": "admin"
}
```

### Atualização de Fornecedor:
```json
{
  "texto": "Atualizou o Fornecedor 'Distribuidora Médica Angola'. Campos alterados: telefone, email, status",
  "action": "update",
  "changes": {
    "telefone": {
      "antigo": "923456789",
      "novo": "923999888"
    },
    "email": {
      "antigo": "contato@distrib.ao",
      "novo": "comercial@distrib.ao"
    },
    "status": {
      "antigo": "ativo",
      "novo": "inativo"
    }
  }
}
```

## 🚀 Como Testar

### 1. Criar um fornecedor:
```bash
POST /api/fornecedores
{
  "nome": "Teste Fornecedor",
  "nif": "999888777",
  "tipo": "nacional",
  "status": "ativo"
}
```

### 2. Ver histórico:
```bash
GET /api/fornecedores/{id}/historico
```

### 3. Atualizar fornecedor:
```bash
PUT /api/fornecedores/{id}
{
  "nome": "Teste Fornecedor Atualizado",
  "status": "inativo"
}
```

### 4. Visualizar histórico na interface:
- Acesse a lista de fornecedores
- Clique numa linha
- Clique no botão "Histórico"
- Veja a timeline completa com todas as atividades

## 🎨 Interface do Usuário

O botão "Histórico" agora está **totalmente funcional**:
- Carrega atividades via AJAX
- Exibe timeline visual com animações
- Mostra detalhes de todas as mudanças
- Formata datas de forma amigável
- Identifica utilizadores e seus papéis

## ✅ Benefícios

1. **Auditoria Completa**: Rastreamento de todas as ações
2. **Conformidade**: Atende requisitos de compliance e GDPR
3. **Debugging**: Facilita identificação de problemas
4. **Transparência**: Utilizadores podem ver histórico de mudanças
5. **Responsabilização**: Identifica quem fez o quê e quando
6. **Análise**: Dados estruturados para relatórios

## 🔮 Sugestões de Melhorias Futuras

1. **Filtros no Histórico**: Por tipo de ação, data, utilizador
2. **Exportação**: Gerar relatórios de auditoria em PDF/Excel
3. **Notificações**: Alertar utilizadores sobre mudanças importantes
4. **Reversão**: Permitir desfazer operações (usando snapshots)
5. **Comparação Visual**: Diff side-by-side de mudanças
6. **Dashboard de Auditoria**: Visualizar todas as atividades do sistema
7. **Retenção Automática**: Arquivar atividades antigas
8. **Busca Avançada**: Pesquisar por texto, utilizador, período
