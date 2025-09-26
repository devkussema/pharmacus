## Estado atual — Seeders e Factories

Data: 26/09/2025

Resumo rápido
- Este documento descreve, arquivo a arquivo, o estado atual das factories e seeders em `database/factories` e `database/seeders`.
- Inclui dependências, ordem de execução, riscos, e recomendações para deixar o processo de seed resiliente e idempotente.

Visão geral dos diretórios
- `database/factories` — contém factories usadas em testes e em seeds rápidos.
- `database/seeders` — contém seeders executados por `DatabaseSeeder` e alguns utilitários (limpeza, backup, migrate-run).

Factories

1) `UserFactory.php`
- Local: `database/factories/UserFactory.php`
- Propósito: gerar instâncias de `App\Models\User` para testes e povoamento rápido.
- Campos gerados: `name`, `email` (único), `email_verified_at`, `password` (hash estático criado na primeira chamada), `remember_token`.
- Observações/risco:
  - A senha padrão usada é `password` (hash aplicada). Para seeds iniciais de conta administrativa prefira criar um seeder explícito com senha segura ou gerar via variáveis de ambiente.
  - Factory é padrão Laravel 9/10; ok para testes.

2) `ProdutoEstoqueFactory.php`
- Local: `database/factories/ProdutoEstoqueFactory.php`
- Propósito: gerar registros em `produto_estoques` para popular estoques durante testes.
- Campos gerados: `designacao`, `dosagem`, `forma`, `tipo`, `farmacia_id`, `caixa`, `caxinha`, `unidade`, `qtd_total`, `origem_destino`, `num_lote`, `data_producao`, `data_expiracao`, `data_recepcao`, `num_documento`, `qtd_embalagem`, `grupo_farmaco_id`, `obs`, `qtd`.
- Observações/risco:
  - Esta factory assume IDs fixos: `farmacia_id => 1` e `grupo_farmaco_id => 1`. Se esses registros não existirem (por exemplo logo após `migrate:fresh` sem seed correspondente) a inserção falhará por FK.
  - Recomendo alterar a factory para procurar ou criar relações dinamicamente, ex:
    - `farmacia_id => App\Models\Farmacia::inRandomOrder()->first()->id ?? Farmacia::factory()->create()->id`.
    - `grupo_farmaco_id => GrupoFarmacologico::inRandomOrder()->first()->id ?? GrupoFarmacologico::factory()->create()->id`.

Seeders (arquivo por arquivo)

Ordem principal de execução
- `DatabaseSeeder::run()` chama, na ordem:
  1. `AHSeeder` (areas hospitalares)
  2. `CategoriasSeeder` (categorias de farmácias)
  3. `GrupoFarmaco` (grupos farmacológicos)
  4. `GrupoSeeder` (grupos de usuário)
  5. `CategoriaProdutoSeeder` (categorias de produtos)
  6. `NiveisDeAlertaSeeder` (níveis de alerta de estoque)
  7. `UserOwnerCreate` (usuário administrador estático)

Descrição dos seeders principais

1) `AHSeeder.php`
- Cria ~40 registros em `areas_hospitalares` com `nome` e `descricao`.
- Sem truncamento; se for executado várias vezes, duplicará registros (não idempotente).
- Recomendação: usar `firstOrCreate(['nome' => ...], [...])` ou truncar/recriar com `DB::statement('SET FOREIGN_KEY_CHECKS=0')` seguido de `truncate()` para garantir idempotência.

2) `CategoriasSeeder.php`
- Cria categorias de farmácia (tipo = 'farmacia').
- Também não idempotente (cria duplicatas se rodado várias vezes).

3) `GrupoFarmaco.php`
- Cria uma longa lista de `GrupoFarmacologico` (muitos nomes e descrições).
- Observações: o seeder usa `truncate()` com `SET FOREIGN_KEY_CHECKS=0` antes de inserir — portanto é idempotente (limpa antes de inserir).

4) `GrupoSeeder.php`
- Cria grupos de usuários (Administrador, Gerente, etc.).
- Não truncado — rodar várias vezes pode duplicar. Recomendo ajustar para `firstOrCreate` ou truncar antes.

5) `CategoriaProdutoSeeder.php`
- Cria categorias de produtos (medicamentos, OTC, etc.).
- Não idempotente (mesma recomendação: usar `firstOrCreate` ou truncar antes).

6) `NiveisDeAlertaSeeder.php`
- Cria 4 níveis de alerta (Critico, Minimo, Médio, Máximo).
- Usa criação em loop e é idempotente somente se os nomes forem únicos protegidos por constraint; caso contrário duplicará. Recomendação: `firstOrCreate`.

7) `UserOwnerCreate.php`
- Cria um usuário com dados explícitos (nome = "Augusto Kussema", email, password já em hash) e associa ao `grupo_id = 1` via `UserGroup::create`.
- Observações/risco:
  - Assume existir `grupo_id = 1` (criado por `GrupoSeeder`). A ordem em `DatabaseSeeder` garante isso.
  - Usa email e senha estáticos — bom para desenvolvimento, mas sensível se o repositório for público.
  - A criação é feita diretamente com `User::create($users)` sem checagem se o email já existe; rodar múltiplas vezes causará erro de unique constraint.

Utilitários e seeders auxiliares

- `ClearTablesSeeder.php`: limpa um conjunto de tabelas específicas (lista em `$tables`) usando `truncate()` com FK checks desabilitados. Útil para testes locais.
- `CleanDbSeeder.php`: truncates todas tables exceto `migrations`. Útil para limpeza total, porém destrutivo em ambientes com dados importantes.
- `BackupDatabaseSeeder.php`: executa `Artisan::call('backup:run')` via pacote Spatie. Útil antes de operações destrutivas; exige configuração do pacote.
- `MigrateSeeder.php`: roda `Artisan::call('migrate')`. Em geral não é comum executar migrate a partir de seeders (ciclo invertido) — usar com cautela.

Riscos e observações gerais

- Muitos seeders não são idempotentes: rodá-los várias vezes causa duplicações ou erros de unique constraint. Recomendo padronizar para `firstOrCreate` ou truncar tabelas quando apropriado.
- Algumas factories assumem IDs fixos (ex.: `farmacia_id => 1` e `grupo_farmaco_id => 1`). Isso gera falhas quando a tabela relacionada não tiver registros. Melhor usar relações dinâmicas ou factories relacionadas.
- `UserOwnerCreate` cria credenciais estáticas (senha e email). Se o repositório for compartilhado, considere remover/parametrizar essa informação e documentar como criar a conta de administrador de forma segura.

Comandos recomendados para uso local (ServBay / DEV)

- Rodar migrations e seeders em desenvolvimento (perigoso em produção):
  1. php artisan migrate:fresh --seed
  2. php artisan db:seed --class=DatabaseSeeder

- Rodar apenas seeders idempotentes (quando ajustados):
  1. php artisan db:seed --class=AHSeeder
  2. php artisan db:seed --class=GrupoFarmaco

- Para popular dados de teste com factories (exemplo seguro):
  - Antes: certifique-se que tabelas relacionadas existam (`farmacia`, `grupo_farmaco`).
  - Exemplo: \App\Models\Farmacia::factory()->create(); \App\Models\GrupoFarmacologico::factory()->create(); \App\Models\ProdutoEstoque::factory()->count(10)->create();

Pequenas melhorias sugeridas (baixo risco)

1) Atualizar `ProdutoEstoqueFactory.php` para buscar/gerar referências dinamicamente, evitando IDs fixos.

2) Tornar seeders idempotentes:
   - Preferir `Model::firstOrCreate(['unique_field' => $value], $attrs)` para não criar duplicatas.
   - Ou usar `truncate()` quando o objetivo for recriar o conjunto inteiro (documentar risco).

3) `UserOwnerCreate`:
   - Verificar existência antes de criar: `User::firstOrCreate(['email' => 'augusto@email.com'], $users)`.
   - Mover credenciais sensíveis para `.env.example` e gerar no deploy com `php artisan tinker` ou um processo seguro.

4) Documentar no README os passos seguros para povoar banco em desenvolvimento, destacando que `migrate:fresh` apagará todos os dados.

Cobertura — arquivos detectados

- Factories:
  - database/factories/UserFactory.php
  - database/factories/ProdutoEstoqueFactory.php

- Seeders:
  - database/seeders/DatabaseSeeder.php
  - database/seeders/AHSeeder.php
  - database/seeders/CategoriasSeeder.php
  - database/seeders/GrupoFarmaco.php
  - database/seeders/GrupoSeeder.php
  - database/seeders/CategoriaProdutoSeeder.php
  - database/seeders/NiveisDeAlertaSeeder.php
  - database/seeders/UserOwnerCreate.php
  - database/seeders/ClearTablesSeeder.php
  - database/seeders/CleanDbSeeder.php
  - database/seeders/BackupDatabaseSeeder.php
  - database/seeders/MigrateSeeder.php

Checklist de requisitos atendidos pelo documento

- [x] Lista completa de arquivos encontrados em factories e seeders.
- [x] Descrição arquivo a arquivo (propósito e campos principais).
- [x] Ordem de execução e dependências destacadas.
- [x] Riscos conhecidos e recomendações concretas de correção.

Próximos passos sugeridos

1. Concorda com as alterações propostas (idempotência e factories dinâmicas)? Se sim, implemente pequenas mudanças e eu posso aplicá-las.
2. Se desejar, posso:
   - Atualizar `ProdutoEstoqueFactory.php` para usar relações dinâmicas.
   - Tornar `AHSeeder`, `CategoriasSeeder`, `GrupoSeeder`, `CategoriaProdutoSeeder` idempotentes via `firstOrCreate`.
   - Substituir `UserOwnerCreate` para usar `firstOrCreate` e ler a senha inicial de `.env`.

Autor: Augusto Kussema
Data de criação: 26/09/2025
