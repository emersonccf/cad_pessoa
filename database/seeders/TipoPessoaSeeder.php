<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPessoaSeeder extends Seeder
{
    protected array $tipo_pessoa = [
        'CLIENTE_PESSOA_FISICA'   => 'CLIENTE PESSOA FÍSICA',
        'CLIENTE_PESSOA_JURIDICA' => 'CLIENTE PESSOA JURÍDICA',
        'DISTRIBUIDOR'            => 'DISTRIBUIDOR',
        'FORNECEDOR'              => 'FORNECEDOR',
        'FUNCIONARIO'             => 'FUNCIONÁRIO',
        'MEDICO'                  => 'MÉDICO',
        'VENDEDOR'                => 'VENDEDOR',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->tipo_pessoa as $chave => $valor){
            DB::table("tipos_pessoas")->insert([
                    "tipo" => $valor,
                    "descricao" => $chave
                ]
            );
        }
    }
}
