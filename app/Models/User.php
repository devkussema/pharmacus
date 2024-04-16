<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'username',
        'email',
        'status',
        'grupo_id',
        'foto_perfil',
        'online',
        'password',
        'email_verified_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->id = Uuid::uuid4()->toString();
            $user->generateUsername();
        });
    }

    public function area_hospitalar()
    {
        return $this->hasOne(UserAreaHospitalar::class, 'user_id');
    }

    public function farmacia(): HasOne
    {
        return $this->hasOne(UserAreaHospitalar::class, 'user_id');
    }

    public function isFarmacia()
    {
        return $this->hasOne(GerenteFarmacia::class, 'user_id');
    }

    /**
     * Cria o nome de usuário com base no nome fornecido.
     *
     * @return void
     */
    protected function generateUsername()
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
        $baseUsername = strtr($this->nome, $accentedChars);

        // Adiciona pontos entre os espaços
        $baseUsername = str_replace(' ', '.', $baseUsername);

        // Remove todos os caracteres especiais exceto letras, números e pontos
        $baseUsername = preg_replace('/[^a-zA-Z0-9.]/', '', $baseUsername);

        // Converte para minúsculas
        $baseUsername = strtolower($baseUsername);

        // Verifica se o nome de usuário já existe
        $username = $baseUsername;
        $count = 1;
        while (User::where('username', $username)->exists()) {
            // Se já existe, acrescenta um número ao final
            $username = $baseUsername . $count;
            $count++;
        }

        $this->username = $username;
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'user_grupos')->limit(1);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function gerente()
    {
        return $this->hasOne(User::class, 'id');
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
