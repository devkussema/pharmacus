<?php

namespace Tests\Feature;

use App\Models\Atividade;
use App\Models\User;
use App\Models\ProdutoEstoque;
use App\Traits\AtividadeTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;

/**
 * Testes de integração para verificar se as atividades são registadas
 * corretamente durante operações reais do sistema.
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-14
 */
class AtividadeIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deve_registrar_atividade_ao_criar_produto_estoque()
    {
        // Arrange
        $user = User::factory()->create([
            'nome' => 'Farmacêutico Teste',
            'email' => 'farmaceutico@teste.com'
        ]);

        $this->actingAs($user);

        // Simular uma classe que usa AtividadeTrait
        $controller = new class {
            use AtividadeTrait;

            public function testeRegistroAtividade($produtoData)
            {
                $meta = [
                    'model_type' => ProdutoEstoque::class,
                    'model_id' => '123',
                    'ip_address' => request()->ip(),
                    'route' => 'estoque.store',
                    'http_method' => 'POST',
                    'level' => 'info',
                    'snapshot_after' => $produtoData,
                ];

                return self::startAtv('Adicionou produto ao estoque: ' . $produtoData['designacao'], null, $meta);
            }
        };

        $produtoData = [
            'designacao' => 'Paracetamol 500mg',
            'tipo' => 'medicamento',
            'dosagem' => '500mg',
            'forma' => 'Comprimido'
        ];

        // Act
        $resultado = $controller->testeRegistroAtividade($produtoData);

        // Assert
        $this->assertTrue($resultado);

        $atividade = Atividade::where('user_id', $user->id)->first();
        $this->assertNotNull($atividade);
    $this->assertStringContainsString('Paracetamol 500mg', $atividade->texto);
        $this->assertEquals(ProdutoEstoque::class, $atividade->model_type);
        $this->assertEquals('123', $atividade->model_id);
        $this->assertEquals('estoque.store', $atividade->route);
        $this->assertEquals('POST', $atividade->http_method);
        $this->assertEquals('info', $atividade->level);
        $this->assertEquals($produtoData, $atividade->snapshot_after);
    }

    /** @test */
    public function deve_registrar_atividade_com_changes_ao_editar_produto()
    {
        // Arrange
        $user = User::factory()->create([
            'nome' => 'Editor Teste',
            'email' => 'editor@teste.com'
        ]);

        $this->actingAs($user);

        // Simular controlador que edita produto
        $controller = new class {
            use AtividadeTrait;

            public function testeEdicaoProduto($original, $novo)
            {
                $changes = [];
                foreach ($novo as $key => $value) {
                    if (array_key_exists($key, $original) && $original[$key] != $value) {
                        $changes[$key] = ['old' => $original[$key], 'new' => $value];
                    }
                }

                $fieldNames = [
                    'designacao' => 'Designação',
                    'dosagem' => 'Dosagem',
                    'obs' => 'Observação',
                ];

                $namedChanges = array_map(function ($key) use ($fieldNames) {
                    return $fieldNames[$key] ?? ucwords(str_replace('_', ' ', $key));
                }, array_keys($changes));

                $fields = implode(', ', $namedChanges);

                $meta = [
                    'model_type' => ProdutoEstoque::class,
                    'model_id' => 'prod_456',
                    'ip_address' => '192.168.1.100',
                    'route' => 'estoque.update',
                    'http_method' => 'PUT',
                    'level' => 'info',
                ];

                return self::startAtv("Editou produto - Campos alterados: {$fields}", $changes, $meta);
            }
        };

        $original = [
            'designacao' => 'Paracetamol',
            'dosagem' => '500mg',
            'obs' => 'Sem observações'
        ];

        $novo = [
            'designacao' => 'Paracetamol Extra',
            'dosagem' => '750mg',
            'obs' => 'Versão fortificada'
        ];

        // Act
        $resultado = $controller->testeEdicaoProduto($original, $novo);

        // Assert
        $this->assertTrue($resultado);

        $atividade = Atividade::where('user_id', $user->id)->first();
        $this->assertNotNull($atividade);
    $this->assertStringContainsString('Designação, Dosagem, Observação', $atividade->texto);

        // Verificar se changes foi gravado corretamente
        $expectedChanges = [
            'designacao' => ['old' => 'Paracetamol', 'new' => 'Paracetamol Extra'],
            'dosagem' => ['old' => '500mg', 'new' => '750mg'],
            'obs' => ['old' => 'Sem observações', 'new' => 'Versão fortificada']
        ];

        $this->assertEquals($expectedChanges, $atividade->changes);
        $this->assertEquals('prod_456', $atividade->model_id);
        $this->assertEquals('192.168.1.100', $atividade->ip_address);
    }

    /** @test */
    public function deve_funcionar_mesmo_quando_usuario_nao_tem_cargo()
    {
        // Arrange
        $user = User::factory()->create([
            'nome' => 'Usuário Sem Cargo',
            'email' => 'sem_cargo@teste.com'
        ]);

        $this->actingAs($user);

        // Simular classe que usa trait
        $controller = new class {
            use AtividadeTrait;

            public function testeUsuarioSemCargo()
            {
                return self::startAtv('Ação de usuário sem cargo definido');
            }
        };

        // Act
        $resultado = $controller->testeUsuarioSemCargo();

        // Assert
        $this->assertTrue($resultado);

        $atividade = Atividade::where('user_id', $user->id)->first();
        $this->assertNotNull($atividade);
        $this->assertEquals('Usuário Sem Cargo', $atividade->user_name);
        $this->assertNull($atividade->actor_role);
    }

    /** @test */
    public function deve_registrar_multiplas_atividades_sequenciais()
    {
        // Arrange
        $user = User::factory()->create(['nome' => 'Usuário Ativo']);
        $this->actingAs($user);

        $controller = new class {
            use AtividadeTrait;

            public function testeMultiplasAtividades()
            {
                $results = [];
                $results[] = self::startAtv('Primeira atividade', null, ['level' => 'info']);
                $results[] = self::startAtv('Segunda atividade', null, ['level' => 'warning']);
                $results[] = self::startAtv('Terceira atividade', null, ['level' => 'error']);

                return $results;
            }
        };

        // Act
        $resultados = $controller->testeMultiplasAtividades();

        // Assert
        $this->assertTrue($resultados[0]);
        $this->assertTrue($resultados[1]);
        $this->assertTrue($resultados[2]);

        $atividades = Atividade::where('user_id', $user->id)->get();
        $this->assertCount(3, $atividades);

        $this->assertEquals('info', $atividades[0]->level);
        $this->assertEquals('warning', $atividades[1]->level);
        $this->assertEquals('error', $atividades[2]->level);
    }
}
