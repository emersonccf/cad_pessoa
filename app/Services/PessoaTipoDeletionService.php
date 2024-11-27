<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PessoaTipo;

class PessoaTipoDeletionService
{
    /**
     * Remove as relações na tabela pessoas_tipos para um determinado pessoa_id e tipo_pessoa_id.
     *
     * @param int $pessoaId
     * @param int $tipoPessoaId
     * @return void
     * @throws \Exception
     */
    public function deletePessoaTipoRelations(int $pessoaId, int $tipoPessoaId): void
    {
        DB::beginTransaction();

        try {
            // Remover as relações na tabela pessoas_tipos
            PessoaTipo::where('pessoa_id', $pessoaId)
                ->where('tipo_pessoa_id', $tipoPessoaId)
                ->delete();

            // Commit da transação
            DB::commit();
        } catch (\Exception $e) {
            // Rollback da transação em caso de erro
            DB::rollBack();
            Log::error('Erro ao deletar relações em pessoas_tipos para pessoa_id: ' . $pessoaId . ' e tipo_pessoa_id: ' . $tipoPessoaId . '. Erro: ' . $e->getMessage());
            throw $e;
        }
    }
}
