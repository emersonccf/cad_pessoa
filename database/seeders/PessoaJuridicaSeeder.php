<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaJuridicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $pessoas_id = [9,10,11,12,13,14,15,16];

        foreach ($pessoas_id as $id) {
            $nome = $faker->unique()->firstName() . " " . $faker->unique()->lastName();
            DB::table("pessoas_juridicas")->insert([
                    'pessoa_id' => $id,
                    'razao_social' => 'E M P R E S A ' . $nome,
                    'cnpj' => $faker->numerify('###.###.###/####'),
                    'rg_ie' => $faker->numerify('##-#####.####-##'),
                    'tipo_contribuinte' => '',
                    'isento_ie_estadual' => '',
                    'responsavel' => $nome,
                ]
            );
        }
    }
}
