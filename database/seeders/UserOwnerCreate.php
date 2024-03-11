<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, UserGroup};

class UserOwnerCreate extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                "nome" => "Augusto Kussema",
                "status" => "1",
                "username" => "augusto.kussema",
                "email" => "augusto@email.com",
                "grupo_id" => 1,
                "foto_perfil" => NULL,
                "email_verified_at" => "2024-02-19 16:19:13",
                "password" => "$2y$12$3FaFZeOaWjPwb7kky7PCWeuFSqLDnm3IwjajW6NshnU.Ydh3zHw0u",
        ];
        
        $usr = User::create($users);

        UserGroup::create([
            'user_id' => $usr->id,
            'grupo_id' => 1
        ]);
    }
}
