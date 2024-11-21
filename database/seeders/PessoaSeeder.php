<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('pt_BR');
        //insere clientes fake
        for ($i = 0; $i < 10; $i++) {
            $nome = $faker->unique()->firstName() . " " . $faker->unique()->lastName();
            DB::table("pessoas")->insert([
                    'status_id' => Status::all()->random()->id,
                    'nome' => $nome,
                    'logradouro' => $faker->streetAddress(),
                    'numero' => $faker->buildingNumber(),
                    'bairro' => $faker->city(),
                    'cidade' => $faker->city(),
                    'uf' =>  strtoupper((Str::random(2))), #TODO: faz com UF reais
                    'complemento' => '',
                    'cep' => $faker->postcode(),
                    'ibge' => '',
                    'telefone' => $faker->phoneNumber(),
                    'celular' => $faker->phoneNumber(),
                    'email' => tornarEmail(converteParaSlug($nome,'.'), $faker->domainName())
                ]
            );
        }
    }
}
