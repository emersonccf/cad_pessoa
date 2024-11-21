<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use App\Models\PessoaTipo;
use App\Models\TipoPessoa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $relacionamentos_pessoa_tipo = [
            1  => [1,5],
            2  => [1,5],
            3  => [6,1],
            4  => [6],
            5  => [1,7],
            6  => [1,7],
            7  => [1],
            8  => [1],
            9  => [2,4],
            10 => [2,4],
            11 => [4],
            12 => [2,3],
            13 => [2,3],
            14 => [3],
            15 => [2],
            16 => [2],
        ];

        //insere relacionamento fake
        foreach ($relacionamentos_pessoa_tipo as $pessoa => $relacionamento)
        {
            foreach ($relacionamento as $tipo_pessoa)
            {
                DB::table("pessoas_tipos")->insert([
                        'numeracao' => PessoaTipo::max('numeracao') + 1,
                        'pessoa_id' => $pessoa,
                        'tipo_pessoa_id' => $tipo_pessoa,
                    ]
                );
            }
        }
    }
}
