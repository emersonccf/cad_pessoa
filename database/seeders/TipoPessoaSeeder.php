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
            2 => [2 => 'pf_f'],
            3 => [3 => 'pf_f_m'],
            4 => [4 => 'pf_f_v'],
            5 => [5 => 'pj_cpj'],
            6 => [6 => 'pj_f'],
            7 => [7 => 'pj_d'],
            // Novas relações podem ser adicionadas aqui ou criado um arquivo a parte de onde podem ser carregados estes relacionamentos
        ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->tipo_pessoa as $chave => $valor){
            $i = 1;
            DB::table("tipos_pessoas")->insert([
                    "tipo" => $valor,
                    "descricao" => $chave,
                    "relacionamento" => $this->relacionamentos[$i][$i],
                ]
            );
            $i = $i + 1;
        }
    }
}
