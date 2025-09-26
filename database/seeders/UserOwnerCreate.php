<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, UserGroup};
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Hash;

class UserOwnerCreate extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('DEV_OWNER_EMAIL', 'augusto@email.com');
        $name = env('DEV_OWNER_NAME', 'Augusto Kussema');
        $username = env('DEV_OWNER_USERNAME', 'augusto.kussema');
        $grupoId = env('DEV_OWNER_GROUP_ID', 1);

        // senha pode ser definida por DEV_OWNER_PASSWORD no .env (texto simples)
        $rawPassword = env('DEV_OWNER_PASSWORD');

        $passwordHash = $rawPassword ? Hash::make($rawPassword) : '$2y$12$3FaFZeOaWjPwb7kky7PCWeuFSqLDnm3IwjajW6NshnU.Ydh3zHw0u';

        $usr = User::firstOrCreate(
            ['email' => $email],
            [
                'nome' => $name,
                'status' => '1',
                'username' => $username,
                'grupo_id' => $grupoId,
                'foto_perfil' => null,
                'email_verified_at' => now(),
                'password' => $passwordHash,
            ]
        );

        // Garante que exista a relação de grupo
        UserGroup::firstOrCreate([
            'user_id' => $usr->id,
            'grupo_id' => $grupoId
        ]);
    }
}
