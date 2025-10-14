<?php

namespace Tests\Unit;

use App\Models\Atividade;
use App\Models\User;
use App\Traits\AtividadeTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Testes para o AtividadeTrait
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-14
 */
class AtividadeTraitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Classe de teste que usa o trait AtividadeTrait
     */
    private $traitUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar uma classe anônima que usa o trait para testar
        $this->traitUser = new class {
            use AtividadeTrait;
        };
    }

    /** @test */
    public function deve_registrar_atividade_basica_quando_usuario_autenticado()
    {
        // Arrange
        $user = User::factory()->create([
            'nome' => 'João Silva',
            'email' => 'joao@teste.com'
        ]);

        $this->actingAs($user);

        // Act
        $resultado = $this->traitUser::startAtv('Teste de atividade básica');

        // Assert
        $this->assertTrue($resultado);
        $this->assertDatabaseHas('atividades', [
            'user_id' => $user->id,
            'texto' => 'Teste de atividade básica',
            'user_name' => 'João Silva'
        ]);
    }

    /** @test */
    public function deve_registrar_atividade_com_changes_e_meta()
    {
        // Arrange
        $user = User::factory()->create([
            'nome' => 'Maria Santos',
            'email' => 'maria@teste.com'
        ]);

        $this->actingAs($user);

        $changes = [
            'nome' => ['old' => 'João', 'new' => 'João Silva'],
            'email' => ['old' => 'joao@old.com', 'new' => 'joao@new.com']
        ];

        $meta = [
            'model_type' => 'App\\Models\\User',
            'model_id' => $user->id,
            'ip_address' => '192.168.1.1',
            'route' => 'users.update',
            'http_method' => 'PUT',
            'level' => 'info',
            'correlation_id' => 'req_123456'
        ];

        // Act
        $resultado = $this->traitUser::startAtv('Editou utilizador', $changes, $meta);

        // Assert
        $this->assertTrue($resultado);

        $atividade = Atividade::where('user_id', $user->id)->first();
        $this->assertNotNull($atividade);
        $this->assertEquals('Editou utilizador', $atividade->texto);
        $this->assertEquals('Maria Santos', $atividade->user_name);
        $this->assertEquals('App\\Models\\User', $atividade->model_type);
        $this->assertEquals($user->id, $atividade->model_id);
        $this->assertEquals('192.168.1.1', $atividade->ip_address);
        $this->assertEquals('users.update', $atividade->route);
        $this->assertEquals('PUT', $atividade->http_method);
        $this->assertEquals('info', $atividade->level);
        $this->assertEquals('req_123456', $atividade->correlation_id);

        // Verificar se changes foi gravado corretamente como JSON
        $this->assertEquals($changes, $atividade->changes);
    }

    /** @test */
    public function deve_registrar_atividade_com_snapshots()
    {
        // Arrange
        $user = User::factory()->create(['nome' => 'Pedro Alves']);
        $this->actingAs($user);

        $snapshotBefore = ['nome' => 'João', 'status' => 'ativo'];
        $snapshotAfter = ['nome' => 'João Silva', 'status' => 'ativo'];

        $meta = [
            'snapshot_before' => $snapshotBefore,
            'snapshot_after' => $snapshotAfter,
            'sensitive' => false
        ];

        // Act
        $resultado = $this->traitUser::startAtv('Atualizou perfil', null, $meta);

        // Assert
        $this->assertTrue($resultado);

        $atividade = Atividade::latest()->first();
        $this->assertEquals($snapshotBefore, $atividade->snapshot_before);
        $this->assertEquals($snapshotAfter, $atividade->snapshot_after);
        $this->assertFalse($atividade->sensitive);
    }

    /** @test */
    public function deve_retornar_false_quando_usuario_nao_autenticado()
    {
        // Act (sem autenticação)
        $resultado = $this->traitUser::startAtv('Tentativa sem autenticação');

        // Assert
        $this->assertFalse($resultado);
        $this->assertDatabaseCount('atividades', 0);
    }

    /** @test */
    public function deve_usar_fallback_quando_colunas_nao_existem()
    {
        // Este teste simula o comportamento quando algumas colunas ainda não existem
        // Arrange
        $user = User::factory()->create(['nome' => 'Ana Costa']);
        $this->actingAs($user);

        // Mock do comportamento quando QueryException é lançada
        $this->mock(Atividade::class, function ($mock) use ($user) {
            $mock->shouldReceive('create')
                 ->once()
                 ->andThrow(new \Illuminate\Database\QueryException(
                     'SQL', // sql
                     [], // bindings
                     new \Exception('Column not found')
                 ));

            $mock->shouldReceive('create')
                 ->once()
                 ->with([
                     'texto' => 'Teste fallback',
                     'user_id' => $user->id
                 ])
                 ->andReturn(new Atividade());
        });

        // Act
        $resultado = $this->traitUser::startAtv('Teste fallback');

        // Assert
        $this->assertTrue($resultado);
    }

    /** @test */
    public function deve_mapear_actor_role_corretamente()
    {
        // Arrange
        $user = User::factory()->create(['nome' => 'Carlos Admin']);

        // Simular que o user tem um cargo primário
        $this->mock(User::class, function ($mock) {
            $mock->shouldReceive('cargoPrimario')
                 ->andReturn((object)['nome' => 'Administrador']);
        });

        $this->actingAs($user);

        // Act
        $resultado = $this->traitUser::startAtv('Teste com cargo');

        // Assert
        $this->assertTrue($resultado);
    }

    /** @test */
    public function deve_lidar_graciosamente_com_erros_inesperados()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Mock para simular erro inesperado
        $this->mock(Atividade::class, function ($mock) {
            $mock->shouldReceive('create')
                 ->andThrow(new \Exception('Erro inesperado'));
        });

        // Act
        $resultado = $this->traitUser::startAtv('Teste com erro');

        // Assert
        $this->assertFalse($resultado);
    }
}
