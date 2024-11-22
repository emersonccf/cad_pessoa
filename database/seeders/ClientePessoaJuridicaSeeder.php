<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientePessoaJuridicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas_id = [1,2,4,5,7,8];

        foreach ($pessoas_id as $id) {
            DB::table("clientes_pessoas_juridicas")->insert([
                    'pessoa_juridica_id' => $id,
                ]
            );
        }
    }
}
