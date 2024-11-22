<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $pessoas_fisicas_id = [1,2,3,4,5,6];

        foreach ($pessoas_fisicas_id as $id) {
            DB::table("funcionarios")->insert([
                    'pessoa_fisica_id' => $id,
                    'data_admissao' => $faker->date(),
                ]
            );
        }
    }
}
