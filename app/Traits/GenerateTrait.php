<?php

namespace App\Traits;

use App\Models\UsersToken as UT;
use Ramsey\Uuid\Uuid;

trait GenerateTrait
{
    public static function gerarSenhaAutomatica()
    {
        // Gera um número aleatório de 100000 a 999999
        $senha = rand(100000, 999999);

        // Converte o número para uma string de 6 dígitos
        $senha = str_pad($senha, 6, '0', STR_PAD_LEFT);

        return $senha;
    }

    public static function gerarToken($user)
    {
        $token = UT::create([
            'user_id' => $user->id,
            'nome' => 'Confirmação de conta de funcionários da farmácia',
            'token' => Uuid::uuid4()->toString()
        ]);

        return $token;
    }
}