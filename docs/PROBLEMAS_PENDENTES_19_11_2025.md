# 🔴 Problemas Pendentes - Sistema Pharmacus

**Data:** 19 de Novembro de 2025  
**Autor:** Augusto Kussema  
**Módulo:** Prepharma - Gestão de Estoque

---

## 📋 Índice
1. [Erro ao Dar Baixa](#1-erro-ao-dar-baixa)
2. [Offcanvas de Detalhes - Informações Incompletas](#2-offcanvas-de-detalhes)
3. [Loading Overlay - CMD/CTRL+R](#3-loading-overlay)
4. [Erro SQLSTATE - Adicionar Item](#4-erro-sqlstate)

---

## 1. 🚨 Erro ao Dar Baixa

### Descrição do Problema
Ao tentar transferir produto entre áreas hospitalares, o sistema retorna erro de validação.

### Erro Exibido
```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'pharmacus.area_hospitalars' doesn't exist
```

### Localização

#### Controller
**Path:** `/app/Prada/Controllers/EstoqueController.php`  
**Método:** `baixa(Request $request)` - Linha ~597

**Código Problemático:**
```php
$request->validate([
    'produto_id' => 'required|exists:produto_estoques,id',
    'area_hospitalar_id' => 'required|exists:area_hospitalars,id', // ❌ TABELA ERRADA
    'quantidade' => 'required|integer|min:1',
    'user_id' => 'nullable|exists:users,id',
    'movement_date' => 'nullable|date',
]);
```

**Correção Necessária:**
```php
'area_hospitalar_id' => 'required|exists:area_hospitalares,id', // ✅ NOME CORRETO
```

#### Model
**Path:** `/app/Models/AreaHospitalar.php`  
**Tabela:** `area_hospitalares` (plural em português)

#### View
**Path:** `/resources/views/prepharma/estoque/_darBaixa.blade.php`

**Estrutura do Formulário:**
```html
<form id="formBaixaEstoque">
    <input type="hidden" name="produto_id" id="baixa_produto_id">
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <input type="hidden" name="quantidade_disponivel">
    
    <select name="area_hospitalar_id" id="baixa_area_select">
        <!-- Áreas disponíveis -->
    </select>
    
    <input type="number" name="quantidade" id="baixa_quantidade">
    <input type="datetime-local" name="movement_date">
</form>
```

#### JavaScript Handler
**Path:** `/resources/views/prepharma/estoque/show.blade.php`  
**Função:** `modalDarBaixa()` - Linha ~1473  
**Submit Handler:** Linha ~1497

**Endpoint AJAX:**
```javascript
fetch('{{ route('estoque.baixa') }}', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: formData
})
```

#### Rota
**Path:** `/routes/main.php`  
**Rota:** `Route::post('/baixa', [EstoqueController::class, 'baixa'])->name('estoque.baixa');`

### Status
❌ **NÃO RESOLVIDO** - Validação ainda aponta para tabela incorreta

---

## 2. 📊 Offcanvas de Detalhes

### Descrição do Problema
O offcanvas de detalhes do produto não exibe todas as informações necessárias:
- ❌ Forma farmacêutica
- ❌ Tipo de produto
- ❌ Quantidade detalhada
- ❌ Grupo farmacológico (às vezes não aparece)

### Localização

#### View Principal
**Path:** `/resources/views/prepharma/estoque/_productDetails.blade.php`

**Script de Renderização:**
```javascript
function renderProductDetails(produto) {
    // Deve incluir:
    // - produto.forma (Comprimido, Injetável, etc)
    // - produto.tipo (medicamento, descartável, líquido)
    // - produto.quantidade (total)
    // - produto.grupo_farmaco.designacao
}
```

#### Controller
**Path:** `/app/Prada/Controllers/EstoqueController.php`  
**Método:** `getDetalhes(int $id)` - Linha ~1128

**Código Atual:**
```php
public function getDetalhes(int $id)
{
    $produto = PE::with([
        'grupo_farmaco',
        'estoque.area_hospitalar',
        'prateleira',
        'status_stock',
        'saldo'
    ])->find($id);

    return response()->json([
        'success' => true,
        'produto' => $produto
    ]);
}
```

**Campos Retornados mas Não Exibidos:**
- `forma` ✅ (existe no banco)
- `tipo` ✅ (existe no banco)
- `quantidade` ✅ (existe no banco)
- `grupo_farmaco->designacao` ⚠️ (depende do relacionamento)

#### Model
**Path:** `/app/Models/ProdutoEstoque.php`

**Relacionamentos Necessários:**
```php
public function grupo_farmaco()
{
    return $this->belongsTo(GrupoFarmacologico::class, 'grupo_farmaco_id');
}

public function prateleira()
{
    return $this->belongsTo(Prateleira::class, 'prateleira_id');
}

public function saldo()
{
    return $this->hasOne(SaldoEstoque::class, 'produto_estoque_id');
}

public function estoque()
{
    return $this->hasOne(Estoque::class, 'produto_estoque_id');
}
```

#### Estrutura Esperada do HTML
```html
<!-- IDENTIFICAÇÃO -->
<div class="detail-section">
    <h6>IDENTIFICAÇÃO</h6>
    <div class="detail-item">
        <span class="detail-label">Designação:</span>
        <span class="detail-value">${produto.designacao}</span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Dosagem:</span>
        <span class="detail-value">${produto.dosagem}</span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Forma:</span>
        <span class="detail-value">${produto.forma}</span> <!-- ❌ NÃO APARECE -->
    </div>
    <div class="detail-item">
        <span class="detail-label">Tipo:</span>
        <span class="detail-value">${produto.tipo}</span> <!-- ❌ NÃO APARECE -->
    </div>
</div>

<!-- QUANTIDADES -->
<div class="detail-section">
    <h6>QUANTIDADES</h6>
    <div class="detail-item">
        <span class="detail-label">Quantidade Total:</span>
        <span class="detail-value">${produto.quantidade}</span> <!-- ❌ NÃO APARECE -->
    </div>
</div>
```

### Status
❌ **NÃO RESOLVIDO** - Script de renderização incompleto

---

## 3. ⏳ Loading Overlay - CMD/CTRL+R

### Descrição do Problema
Ao pressionar CMD+R (Mac) ou CTRL+R (Windows) para recarregar a página, o overlay de loading não é exibido.

### Localização

#### Layout Principal
**Path:** `/resources/views/prepharma/layout/app.blade.php`

**HTML do Overlay:**
```html
<!-- Loading Overlay Global -->
<div id="globalLoadingOverlay" class="global-loading-overlay">
    <div class="loading-content">
        <div class="loading-spinner-large"></div>
        <p class="loading-text">Carregando...</p>
    </div>
</div>
```

**CSS:**
```css
.global-loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(8px);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 99999;
}

.global-loading-overlay.active {
    display: flex !important;
}
```

**JavaScript Necessário:**
```javascript
// Função global para mostrar loading
function showLoading() {
    document.getElementById('globalLoadingOverlay')?.classList.add('active');
}

// Função global para esconder loading
function hideLoading() {
    document.getElementById('globalLoadingOverlay')?.classList.remove('active');
}

// Listener para beforeunload
window.addEventListener('beforeunload', function() {
    showLoading();
});

// Listener para CMD/CTRL + R
document.addEventListener('keydown', function(e) {
    if ((e.metaKey || e.ctrlKey) && e.key === 'r') {
        showLoading();
    }
});

// Esconder após carregar
window.addEventListener('load', function() {
    hideLoading();
});
```

### Status
❌ **NÃO RESOLVIDO** - Event listeners não estão funcionando corretamente

---

## 4. 🗄️ Erro SQLSTATE - Adicionar Item

### Descrição do Problema
Erro de tabela inexistente ao tentar adicionar produto ao estoque.

### Erro Exibido
```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'pharmacus.area_hospitalars' doesn't exist
```

### Localização

#### View
**Path:** `/resources/views/prepharma/estoque/adicionar-item.blade.php`

**Código Problemático:**
```blade
@foreach (App\Models\FarmaciaAreaHospitalar::where('farmacia_id', auth()->user()->isFarmacia->farmacia->id)->where('status', 1)->get() as $areas)
    <option value="{{ $areas->area_hospitalar->id }}">
        {{ $areas->area_hospitalar->nome }}
    </option>
@endforeach
```

**Campo Hidden Necessário:**
```blade
<input type="hidden" name="area_id" value="{{ $ah->id ?? '' }}">
```

#### Controller
**Path:** `/app/Prada/Controllers/EstoqueController.php`  
**Método:** `store(Request $request)` - Linha ~390

**Validação:**
```php
$request->validate([
    'designacao' => 'required',
    'dosagem' => 'nullable',
    'forma' => 'required',
    'tipo' => 'required',
    'farmacia_id' => 'required',
    'quantidade' => 'required|integer|min:1',
    'area_id' => 'required|exists:area_hospitalares,id', // ✅ DEVE EXISTIR
    // ... outros campos
]);
```

#### Model
**Path:** `/app/Models/FarmaciaAreaHospitalar.php`

**Relacionamento:**
```php
public function area_hospitalar()
{
    return $this->belongsTo(AreaHospitalar::class, 'area_hospitalar_id');
}
```

### Status
⚠️ **PARCIALMENTE RESOLVIDO** - Campo hidden adicionado, mas pode haver outros pontos de falha

---

## 🗂️ Estrutura de Arquivos Envolvidos

```
pharmacus/
├── app/
│   ├── Models/
│   │   ├── ProdutoEstoque.php (PE)
│   │   ├── SaldoEstoque.php (SE)
│   │   ├── Estoque.php
│   │   ├── AreaHospitalar.php (AH)
│   │   ├── FarmaciaAreaHospitalar.php (FAH)
│   │   ├── GrupoFarmacologico.php
│   │   └── Prateleira.php
│   └── Prada/
│       └── Controllers/
│           └── EstoqueController.php
├── routes/
│   └── main.php
├── resources/
│   └── views/
│       └── prepharma/
│           ├── layout/
│           │   └── app.blade.php
│           └── estoque/
│               ├── show.blade.php
│               ├── adicionar-item.blade.php
│               ├── _darBaixa.blade.php
│               ├── _productDetails.blade.php
│               └── _addStock.blade.php
└── database/
    └── migrations/
        └── *_create_area_hospitalares_table.php
```

---

## 🎯 Tabelas do Banco de Dados

### Tabelas Principais

#### `area_hospitalares` ✅
```sql
CREATE TABLE `area_hospitalares` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

#### `produto_estoques` ✅
```sql
CREATE TABLE `produto_estoques` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `designacao` varchar(255) NOT NULL,
  `dosagem` varchar(255) DEFAULT NULL,
  `forma` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `quantidade` int NOT NULL DEFAULT '0',
  `num_lote` varchar(255) DEFAULT NULL,
  `data_expiracao` date DEFAULT NULL,
  `data_producao` date DEFAULT NULL,
  `data_recepcao` date DEFAULT NULL,
  `grupo_farmaco_id` bigint unsigned DEFAULT NULL,
  `prateleira_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

#### `saldo_estoques` ✅
```sql
CREATE TABLE `saldo_estoques` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produto_estoque_id` bigint unsigned NOT NULL,
  `qtd` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`produto_estoque_id`) REFERENCES `produto_estoques` (`id`)
);
```

---

## ✅ Checklist de Correções

### Problema 1: Dar Baixa
- [x] Identificado nome incorreto da tabela
- [ ] Corrigir validação no controller (`area_hospitalars` → `area_hospitalares`)
- [ ] Testar transferência entre áreas
- [ ] Verificar histórico de produtos
- [ ] Confirmar notificações

### Problema 2: Offcanvas Detalhes
- [x] Endpoint retorna dados completos
- [ ] Renderizar campo `forma`
- [ ] Renderizar campo `tipo`
- [ ] Renderizar campo `quantidade` corretamente
- [ ] Verificar exibição do grupo farmacológico
- [ ] Testar com diferentes tipos de produtos

### Problema 3: Loading Overlay
- [x] HTML do overlay criado
- [x] CSS do overlay criado
- [ ] Event listener beforeunload funcionando
- [ ] Event listener keydown (CMD/CTRL+R) funcionando
- [ ] Função showLoading() global
- [ ] Função hideLoading() global
- [ ] Testar em diferentes navegadores

### Problema 4: Adicionar Item
- [x] Campo hidden `area_id` adicionado
- [ ] Remover select duplicado (se existir)
- [ ] Validar area_id no backend
- [ ] Testar cadastro completo
- [ ] Verificar criação de saldo
- [ ] Verificar criação de estoque

---

## 🔧 Comandos Úteis para Debug

### Verificar Estrutura do Banco
```bash
php artisan tinker

# Verificar tabelas
DB::select('SHOW TABLES');

# Verificar estrutura da tabela
DB::select('DESCRIBE area_hospitalares');

# Testar query
App\Models\AreaHospitalar::all();
```

### Limpar Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Recriar Autoload
```bash
composer dump-autoload
```

---

## 📝 Notas Adicionais

1. **Consistência de Nomenclatura:** O sistema mistura inglês e português nos nomes das tabelas. Considerar padronização futura.

2. **Validação de Existência:** Sempre usar `exists:tabela_correta,id` nas validações para evitar erros SQL.

3. **Relacionamentos Eloquent:** Garantir que todos os relacionamentos estejam corretamente definidos nos models.

4. **AJAX vs Form Submit:** Decidir padrão único (atualmente misto).

5. **Error Handling:** Implementar tratamento de erros mais robusto nos handlers JavaScript.

---

**Última Atualização:** 19/11/2025 12:40 (Luanda)  
**Próxima Revisão:** Após correções implementadas
