<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        $nome = strtolower(trim($this->nome));
        $this->username = str_replace(' ', '.', $nome);
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
