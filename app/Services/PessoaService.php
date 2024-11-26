<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Pessoa;

/**
 * Classe destinada a serviços para a classe pessoa: concentra as regras de negócios
 */
class PessoaService
{
    protected $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * Salva todas as alterações, em cascata, que foram realizadas em uma pessoa e em seus relacionamentos
     */
    public function saveAll()
    {
        // Definir regras de validação de forma dinâmica
        $rules = $this->getValidationRules();

        // Executar a validação
        $validator = Validator::make($this->pessoa->attributesToArray(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            DB::transaction(function ()
            {
                // Carregar relações dinamicamente
                $this->loadRelations();

                // Salvar a pessoa e suas relações
                $this->pessoa->save();

                // Salvar relações de forma dinâmica
                foreach ($this->pessoa->getRelations() as $relationName => $relation)
                {
                    if ($relation) {
                        if (is_iterable($relation))
                        {
                            foreach ($relation as $item)
                            {
                                if (method_exists($item, 'save'))
                                {
                                    $item->save();
                                }
                            }
                        } elseif (method_exists($relation, 'save'))
                        {
                            $relation->save();
                        }
                    }
                }
            });
        } catch (ValidationException $e) {
            Log::warning('Erro de validação: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar Pessoa e suas relações: ' . $e->getMessage());
            throw new \Exception('Houve um problema ao salvar os dados. Por favor, tente novamente.');
        }
    }

    /**
     * Retorna um array com todas as regras de validações a serem realizadas
     * @return array - com todos os campos e suas respectivas regras de validação
     */
    protected function getValidationRules()
    {
        return [
            'nome' => 'required|string|max:80',
            'email' => 'nullable|email|max:100|unique:pessoas,email,' . $this->pessoa->id,
            // Adicione outras regras conforme necessário
        ];
    }

    /**
     * Carrega todos os possíveis relacionamentos de uma pessoa
     */
    protected function loadRelations()
    {
        $relations = $this->pessoa->getDefinedRelations();
        $this->pessoa->load($relations);
    }
}
