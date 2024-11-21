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
        //insere relacionamento fake
        for ($i = 0; $i < 15; $i++) {
            DB::table("pessoas_tipos")->insert([
                    'numeracao' => PessoaTipo::max('numeracao') + 1,
                    'pessoa_id' => Pessoa::all()->random()->id,
                    'tipo_pessoa_id' => TipoPessoa::all()->random()->id,
                ]
            );
        }
    }
}
