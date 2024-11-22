<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaFisicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $pessoas_id = [1,2,3,4,5,6,7,8];

        foreach ($pessoas_id as $id) {
            DB::table("pessoas_fisicas")->insert([
                    'pessoa_id' => $id,
                    'cpf' => $faker->numerify('###.###.###-##'),
                    'rg' => $faker->numerify('##.###.###'),
//                    'identidade_estrangeiro' => ,
                    'data_nascimento' => $faker->date(),
                ]
            );
        }
    }
}
