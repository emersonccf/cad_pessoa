<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $funcionarios_id = [5,6];

        foreach ($funcionarios_id as $id) {
            DB::table("vendedores")->insert([
                    'funcionario_id' => $id,
                    'comissao' => $faker->randomFloat(2,10,20),
                ]
            );
        }
    }
}
