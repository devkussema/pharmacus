<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

/**
 * Modelo User
 *
 * Representa um utilizador do sistema.
 *
 * Autor: Augusto Kussema
 * Data: 2025-09-27
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'grupo_id',
        'status',
        'foto_perfil',
    ];

    /**
     * Casts úteis.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'status' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user): void {
            $user->id = Uuid::uuid4()->toString();
            $user->generateUsername();
        });
    }

    /**
     * Área hospitalar associada (se aplicável).
     *
     * @return HasOne
     */
    public function area_hospitalar(): HasOne
    {
        return $this->hasOne(UserAreaHospitalar::class, 'user_id');
    }

    /**
     * Relação com a farmácia (se aplicável).
     *
     * @return HasOne
     */
    public function farmacia(): HasOne
    {
        // A relação originalmente retornava UserAreaHospitalar; para obter a
        // farmácia associada a este utilizador, consultamos a relação
        // `area_hospitalar`/`farmacia` através do modelo pivot `UserAreaHospitalar`.
        // Mantemos um acesso directo ao pivot para compatibilidade.
        return $this->hasOne(UserAreaHospitalar::class, 'user_id');
    }

    /**
     * Relação com GerenteFarmacia (isFarmacia).
     *
     * @return HasOne
     */
    public function isFarmacia(): HasOne
    {
        return $this->hasOne(GerenteFarmacia::class, 'user_id');
    }

    /**
     * Cria o nome de usuário (username) com base no campo nome.
     *
     * Remove acentos, substitui espaços por pontos, remove caracteres especiais
     * e garante unicidade acrescentando sufixo numérico quando necessário.
     *
     * @return void
     */
    protected function generateUsername(): void
    {
        // Remove acentos manualmente
        $accentedChars = [
            'á' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a', 'ã' => 'a', 'å' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'õ' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c',
            'ñ' => 'n',
            'Á' => 'A', 'À' => 'A', 'Â' => 'A', 'Ä' => 'A', 'Ã' => 'A', 'Å' => 'A',
            'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ó' => 'O', 'Ò' => 'O', 'Ô' => 'O', 'Ö' => 'O', 'Õ' => 'O',
            'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'Ç' => 'C',
            'Ñ' => 'N'
        ];
        $baseUsername = strtr($this->nome ?? '', $accentedChars);

        // Adiciona pontos entre os espaços
        $baseUsername = str_replace(' ', '.', $baseUsername);

        // Remove todos os caracteres especiais exceto letras, números e pontos
        $baseUsername = preg_replace('/[^a-zA-Z0-9.]/', '', $baseUsername);

        // Converte para minúsculas
        $baseUsername = strtolower($baseUsername);

        // Verifica se o nome de usuário já existe
        $username = $baseUsername;
        $count = 1;
        while (self::where('username', $username)->exists()) {
            $username = $baseUsername . $count;
            $count++;
        }

        $this->username = $username;
    }

    /**
     * Relação many-to-many com grupos (limite 1).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'user_grupos')->limit(1);
    }

    /**
     * Relação belongsTo para o grupo principal.
     *
     * @return BelongsTo
     */
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Retorna a URL do perfil (útil para JS).
     *
     * @return string
     */
    public function getPerfilUrlAttribute(): string
    {
        return route('u.perfil', ['username' => $this->id]);
    }

    /**
     * Retorna a URL pública da foto de perfil ou uma imagem default.
     *
     * @return string
     */
    public function getFotoPerfilUrlAttribute(): string
    {
        if ($this->foto_perfil) {
            return url('storage/'.$this->foto_perfil);
        }

        return asset('assets/images/default-avatar.png');
    }
}
