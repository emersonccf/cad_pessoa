<?php

namespace App\Services;

use Illuminate\Database\QueryException;
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
     * Salva todas as alterações que foram realizadas em uma pessoa e em seus relacionamentos existentes através do push()
     * Esse método não é capaz de salvar relacionamentos novos como, por exemplo, associar a novo tipo de pessoa
     * para este fim utilize o create() e faça a devida associação pela chave primaria
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

        try
        {
            DB::transaction(function ()
            {
                // Salvar a pessoa e suas relações
                $this->pessoa->push();

            });
        }
        catch (ValidationException $e)
        {
            Log::warning('Erro de validação: ' . $e->getMessage());
            throw $e;
        } catch (QueryException $e)
        {
            Log::error('Erro ao salvar Pessoa e suas relações: ' . $e->getMessage());
            throw new \Exception('Houve um problema ao salvar os dados. Por favor, tente novamente.');
        } catch (\Exception $e)
        {
            Log::error('Erro inesperado: ' . $e->getMessage());
            throw new \Exception('Um erro inesperado ocorreu. Por favor, contate o suporte.');
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
}
