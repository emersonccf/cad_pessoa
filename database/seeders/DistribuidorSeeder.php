<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistribuidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas_id = [4,5,6];

        foreach ($pessoas_id as $id) {
            DB::table("distribuidores")->insert([
                    'pessoa_juridica_id' => $id,
                ]
            );
        }
    }
}
