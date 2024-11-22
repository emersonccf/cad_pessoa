<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas_id = [1,2,3];

        foreach ($pessoas_id as $id) {
            DB::table("fornecedores")->insert([
                    'pessoa_juridica_id' => $id,
                ]
            );
        }
    }
}
