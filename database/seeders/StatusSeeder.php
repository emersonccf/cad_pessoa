<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    protected array $status = [
        "ATIVO"             => "ATIVO",
        "INATIVO"           => "INATIVO",
        "BLOQUEADO"         => "BLOQUEADO",
        "LIBERADO"          => "LIBERADO",
        "DEMO"              => "DEMO",
        "NAO_ASSINANTE"     => "NÃO ASSINANTE",
        "NOVO"              => "NOVO",
        ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->status as $chave => $valor){
            DB::table("status")->insert([
                    "status" => $valor,
                    "descricao" => $chave
                ]
            );
        }

    }
}
