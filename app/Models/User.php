<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Ramsey\Uuid\Uuid;

/**
 * Modelo User
 *
 * Representa um utilizador do sistema.
 *
 * autor: Augusto Kussema
 * Data: 2025-10-21 09:30 (Luanda)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
        'password',
        'estado',
        'pode_cadastrar_produtos', // Nova coluna
        'role', // role do utilizador: super_admin|admin|user
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
        'pode_cadastrar_produtos' => 'boolean', // Cast automático
    ];

    // Roles disponíveis
    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user): void {
            $user->id = Uuid::uuid4()->toString();
            $user->generateUsername();
            // Assegura role por defeito
            if (empty($user->role)) {
                $user->role = self::ROLE_USER;
            }
        });
    }

    /**
     * Relação com o pivot UserAreaHospitalar.
     *
     * Um utilizador pode ter várias entradas em UserAreaHospitalar,
     * cada uma contendo (por exemplo) area_id, farmacia_id e cargo_id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAreaHospitalares()
    {
        return $this->hasMany(UserAreaHospitalar::class, 'user_id');
    }

    /**
     * Recupera os cargos associados ao utilizador através de UserAreaHospitalar.
     *
     * Uso sugerido:
     * - $user->cargos() -> Collection de App\Models\Cargo
     * - $user->cargoPrimario() -> Cargo|null (primeiro cargo associado)
     *
     * @return \Illuminate\Support\Collection
     */
    public function cargos()
    {
        return $this->userAreaHospitalares()
            ->with('cargo')
            ->get()
            ->map(fn (UserAreaHospitalar $uah) => $uah->cargo)
            ->filter();
    }
    /**
     * Retorna o cargo primário (primeiro encontrado) associado via UserAreaHospitalar.
     *
     * @return Cargo|null
     */
    public function cargoPrimario()
    {
        return $this->userAreaHospitalares()
            ->with('cargo')
            ->first()?->cargo ?? null;
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

    /**
     * Relacionamento para obter o cargo do usuário através de UserAreaHospitalar
     *
     * @return HasOneThrough
     */
    public function cargo()
    {
        return $this->hasOneThrough(
            Cargo::class,           // Model final (Cargo)
            UserAreaHospitalar::class, // Model intermediário (UserAreaHospitalar)
            'user_id',             // Chave estrangeira na tabela intermediária (user_area_hospitalares.user_id)
            'id',                  // Chave estrangeira na tabela final (cargos.id)
            'id',                  // Chave local na tabela atual (users.id)
            'cargo_id'             // Chave local na tabela intermediária (user_area_hospitalares.cargo_id)
        );
    }

    /**
     * Relacionamento direto com UserAreaHospitalar
     *
     * @return HasOne
     */
    public function userAreaHospitalar()
    {
        return $this->hasOne(UserAreaHospitalar::class, 'user_id');
    }

    /**
     * Relacionamento para obter a área hospitalar do usuário
     *
     * @return HasOneThrough
     */
    public function areaHospitalar()
    {
        return $this->hasOneThrough(
            AreaHospitalar::class,
            UserAreaHospitalar::class,
            'user_id',
            'id',
            'id',
            'area_hospitalar_id'
        );
    }

    /**
     * Verificar se o usuário pode cadastrar produtos
     *
     * @return bool
     */
    public function podeUsuarioCadastrarProdutos()
    {
        return $this->pode_cadastrar_produtos;
    }

    /**
     * Verifica se o utilizador é super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    /**
     * Verifica se o utilizador é admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN || $this->isSuperAdmin();
    }

    /**
     * Verifica se o utilizador é um utilizador padrão.
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * Dar permissão para cadastrar produtos
     *
     * @return bool
     */
    public function permitirCadastrarProdutos()
    {
        $this->pode_cadastrar_produtos = true;
        return $this->save();
    }

    /**
     * Remover permissão para cadastrar produtos
     *
     * @return bool
     */
    public function proibirCadastrarProdutos()
    {
        $this->pode_cadastrar_produtos = false;
        return $this->save();
    }
}
