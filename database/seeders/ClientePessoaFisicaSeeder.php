<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientePessoaFisicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $pessoas_fisicas_id = [1,2,3,5,6,7,8];

        foreach ($pessoas_fisicas_id as $id) {
            DB::table("clientes_pessoas_fisicas")->insert([
                    'pessoa_fisica_id' => $id,
                    'desconto' => $faker->randomFloat(2,0,4),
                ]
            );
        }
    }
}
