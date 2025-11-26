<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Modelo Fornecedor
 *
 * Representa um fornecedor de produtos farmacêuticos.
 *
 * @author Augusto Kussema
 * @date 26 Nov 2025 14:36 (Luanda)
 * @description Modelo para gestão de fornecedores de produtos e medicamentos
 */
class Fornecedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fornecedores';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'nif',
        'email',
        'telefone',
        'telemovel',
        'whatsapp',
        'endereco',
        'cidade',
        'provincia',
        'pais',
        'codigo_postal',
        'website',
        'pessoa_contacto',
        'cargo_contacto',
        'tipo',
        'status',
        'observacoes',
        'avaliacao',
        'conta_bancaria',
        'banco',
        'iban',
    ];

    /**
     * Casts de atributos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'avaliacao' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Tipos de fornecedor disponíveis.
     */
    public const TIPO_NACIONAL = 'nacional';
    public const TIPO_INTERNACIONAL = 'internacional';

    /**
     * Status disponíveis.
     */
    public const STATUS_ATIVO = 'ativo';
    public const STATUS_INATIVO = 'inativo';
    public const STATUS_BLOQUEADO = 'bloqueado';

    /**
     * Boot do modelo.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Fornecedor $fornecedor): void {
            if (empty($fornecedor->id)) {
                $fornecedor->id = Uuid::uuid4()->toString();
            }

            // Define valores padrão se não fornecidos
            if (empty($fornecedor->tipo)) {
                $fornecedor->tipo = self::TIPO_NACIONAL;
            }

            if (empty($fornecedor->status)) {
                $fornecedor->status = self::STATUS_ATIVO;
            }

            if (empty($fornecedor->pais)) {
                $fornecedor->pais = 'Angola';
            }
        });
    }

    /**
     * Produtos fornecidos por este fornecedor.
     *
     * @return HasMany
     */
    public function produtos(): HasMany
    {
        return $this->hasMany(ProdutoEstoque::class, 'fornecedor_id');
    }

    /**
     * Histórico de movimentações relacionadas ao fornecedor.
     *
     * @return HasMany
     */
    public function historicos(): HasMany
    {
        return $this->hasMany(ProductHistory::class, 'fornecedor_id');
    }

    /**
     * Verifica se o fornecedor está ativo.
     *
     * @return bool
     */
    public function isAtivo(): bool
    {
        return $this->status === self::STATUS_ATIVO;
    }

    /**
     * Verifica se o fornecedor está inativo.
     *
     * @return bool
     */
    public function isInativo(): bool
    {
        return $this->status === self::STATUS_INATIVO;
    }

    /**
     * Verifica se o fornecedor está bloqueado.
     *
     * @return bool
     */
    public function isBloqueado(): bool
    {
        return $this->status === self::STATUS_BLOQUEADO;
    }

    /**
     * Verifica se é fornecedor nacional.
     *
     * @return bool
     */
    public function isNacional(): bool
    {
        return $this->tipo === self::TIPO_NACIONAL;
    }

    /**
     * Verifica se é fornecedor internacional.
     *
     * @return bool
     */
    public function isInternacional(): bool
    {
        return $this->tipo === self::TIPO_INTERNACIONAL;
    }

    /**
     * Ativa o fornecedor.
     *
     * @return bool
     */
    public function ativar(): bool
    {
        $this->status = self::STATUS_ATIVO;
        return $this->save();
    }

    /**
     * Desativa o fornecedor.
     *
     * @return bool
     */
    public function desativar(): bool
    {
        $this->status = self::STATUS_INATIVO;
        return $this->save();
    }

    /**
     * Bloqueia o fornecedor.
     *
     * @return bool
     */
    public function bloquear(): bool
    {
        $this->status = self::STATUS_BLOQUEADO;
        return $this->save();
    }

    /**
     * Retorna o nome completo formatado para exibição.
     *
     * @return string
     */
    public function getNomeCompletoAttribute(): string
    {
        $nif = $this->nif ? " (NIF: {$this->nif})" : '';
        return "{$this->nome}{$nif}";
    }

    /**
     * Retorna o contacto principal (prioriza whatsapp, depois telemovel, depois telefone).
     *
     * @return string|null
     */
    public function getContactoPrincipalAttribute(): ?string
    {
        return $this->whatsapp ?? $this->telemovel ?? $this->telefone;
    }

    /**
     * Retorna a avaliação formatada com estrelas.
     *
     * @return string
     */
    public function getAvaliacaoFormatadaAttribute(): string
    {
        if (!$this->avaliacao) {
            return 'Sem avaliação';
        }

        $estrelas = str_repeat('⭐', (int) round($this->avaliacao));
        return "{$estrelas} ({$this->avaliacao}/5)";
    }

    /**
     * Scope para filtrar apenas fornecedores ativos.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAtivos($query)
    {
        return $query->where('status', self::STATUS_ATIVO);
    }

    /**
     * Scope para filtrar por tipo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $tipo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorTipo($query, string $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Scope para buscar por nome ou NIF.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $termo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBuscar($query, string $termo)
    {
        return $query->where(function ($q) use ($termo) {
            $q->where('nome', 'LIKE', "%{$termo}%")
              ->orWhere('nif', 'LIKE', "%{$termo}%");
        });
    }
}
