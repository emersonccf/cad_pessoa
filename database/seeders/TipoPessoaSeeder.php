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

    protected array $relacionamentos = [
            1 => [1 => 'pf_cpf'],
            2 => [2 => 'pj_cpj'],
            3 => [3 => 'pj_d'],
            4 => [4 => 'pj_f'],
            5 => [5 => 'pf_f'],
            6 => [6 => 'pf_f_m'],
            7 => [7 => 'pf_f_v'],
            // Novas relações podem ser adicionadas aqui ou criado um arquivo a parte de onde podem ser carregados estes relacionamentos
        ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i = 1;
        foreach($this->tipo_pessoa as $chave => $valor){
            DB::table("tipos_pessoas")->insert([
                    "tipo" => $valor,
                    "descricao" => $chave,
                    "relacionamento" => $this->relacionamentos[$i][$i],
                ]
            );
            $i =  $i + 1;
        }
    }
}
