<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $funcionarios_id = [3,4];

        foreach ($funcionarios_id as $id) {
            DB::table("medicos")->insert([
                    'funcionario_id' => $id,
                    'crm' => $faker->numerify('###.###'),
                ]
            );
        }
    }
}
