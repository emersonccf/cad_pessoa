<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\PessoaTipo;
use App\Models\TipoPessoa;

class PessoaTipoService
{
    /**
     * Cria um registro em PessoaTipo baseado nas relações e tipo de pessoa.
     * A classe de serviço lida com a lógica de transformação e iteração, mantendo o código limpo e eficiente.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $relations - Relações a serem carregadas em formato de string ex: 'pessoa_fisica' ou 'pessoa_fisica.funcionario' etc.
     * @param string $tipoPessoa
     * @return void
     */
    public static function createPessoaTipo(\Illuminate\Database\Eloquent\Model $model, string $relations, string $tipoPessoa)
    {
        // Transformar a string de relações em um array e inverter a ordem
        $relationsArray = array_reverse(explode('.', $relations));

        $related = $model;

        // Carregar cada relação na ordem invertida
        foreach ($relationsArray as $relation) {
            if (!$related->relationLoaded($relation)) {
                $related->load($relation);
            }

            $related = $related->$relation;

            // Se a relação atual não for encontrada, log e saia
            if (!$related) {
                Log::warning("Relação $relation não encontrada para Model ID: " . $model->id);
                return;
            }
        }

        // Obtenha o ID da pessoa associada
        $pessoaId = $related->pessoa_id ?? null;

        if ($pessoaId) {
            $tipoPessoaId = TipoPessoa::getIdByTipo($tipoPessoa);

            PessoaTipo::create([
                'pessoa_id' => $pessoaId,
                'tipo_pessoa_id' => $tipoPessoaId,
            ]);
        } else {
            Log::warning("Pessoa não encontrada para Model ID: " . $model->id);
        }
    }
}
