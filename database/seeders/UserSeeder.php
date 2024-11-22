<?php

namespace Database\Seeders;

//use App\Models\User;
//use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::factory(10)->create();

        $faker = fake('pt_BR');

        //insere uma conta administrativa padrão
        try {
            DB::table("users")->insert([
                    'name' => "Administrador",
                    'email' => "admin@admin.com",
                    'email_verified_at' => now(),
                    'password' => bcrypt('123'),
                    'remember_token' => Str::random(10),
                ]
            );
        } catch (UniqueConstraintViolationException $e) {
            echo 'ERRO: ' . $e->errorInfo[2]. ' '. 'Usuário com e-mail administrativo já exite.';
        }
        //insere usuário fake
        for ($i = 0; $i < 10; $i++) {
            $nome = $faker->unique()->firstName() . " " . $faker->unique()->lastName();
            DB::table("users")->insert([
                    'name' => $nome,
//                    'email' => $faker->unique()->safeEmail(),
                    'email' => tornarEmail(converteParaSlug($nome,'.'), $faker->domainName()),
                    'email_verified_at' => now(),
                    'password' => bcrypt('123'),
                    'remember_token' => Str::random(10),
                ]
            );
        }
    }
}
