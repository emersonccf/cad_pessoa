<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        $ufs = ufsBr();

        //insere clientes fake
        for ($i = 0; $i < 16; $i++) {
            $nome = $faker->unique()->firstName() . " " . $faker->unique()->lastName();
            $nome = ($i < 8) ? $nome : 'E M P R E S A '. $nome;
            DB::table("pessoas")->insert([
                    'status_id' => Status::all()->random()->id,
                    'nome' => $nome,
                    'logradouro' => $faker->streetAddress(),
                    'numero' => $faker->buildingNumber(),
                    'bairro' => $faker->citySuffix(),
                    'cidade' => $faker->city(),
                    'uf' => $ufs[array_rand($ufs)],
                    'complemento' => '',
                    'cep' => $faker->postcode(),
                    'ibge' => $faker->numerify('########'),
                    'telefone' => $faker->phoneNumber(),
                    'celular' => $faker->phoneNumber(),
                    'email' => tornarEmail(converteParaSlug($nome,'.'), $faker->domainName())
                ]
            );
        }
    }
}
