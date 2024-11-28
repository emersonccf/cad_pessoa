<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['pessoa_fisica_id', 'data_admissao'];
    public $timestamps = false;
    private static string $tipoPessoa= 'FUNCIONÁRIO';

    public function pessoa_fisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    public function vendedor()
    {
        return $this->hasOne(Vendedor::class);
    }

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    protected static function boot()
    {
        parent::boot();
        $tipo_pessoa_loc = static::$tipoPessoa;

        static::created(function ($model) use ($tipo_pessoa_loc) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica', $tipo_pessoa_loc);
        });

        static::deleting(function ($model) use ($tipo_pessoa_loc) {

            #TODO Trabalhar para abstrair toda essa rotina abaixo e transformar em outro serviço
            try
            {
                DB::transaction( function () use ($model, $tipo_pessoa_loc) {
                    $service = new PessoaTipoDeletionService();

                    // Deletar relação do próprio Funcionário
                    $funcionarioId = $model->id;
                    $pessoaId = Funcionario::find($funcionarioId)->load('pessoa_fisica')->pessoa_fisica->pessoa_id;
                    $tipoPessoaId = TipoPessoa::getIdByTipo($tipo_pessoa_loc);
                    $service->deletePessoaTipoRelations($pessoaId, $tipoPessoaId);

                    // Deletar relação do Médico, se existir
                    $medicoId = $model->funcionario->load('medico')->medico->id;
                    if ($medicoId) {
                        $medicoPessoaId = Medico::find($medicoId)->load('funcionario')->funcionario->load('pessoa_fisica')->pessoa_fisica->pessoa_id;
                        $medicoTipoPessoaId = TipoPessoa::getIdByTipo('MÉDICO');
                        $service->deletePessoaTipoRelations($medicoPessoaId, $medicoTipoPessoaId);
                    }

                    // Deletar relação do Vendedor, se existir
                    $vendedorId = $model->funcionario->load('vendedor')->medico->id;
                    if ($vendedorId) {
                        $vendedorPessoaId = Vendedor::find($vendedorId)->load('funcionario')->funcionario->load('pessoa_fisica')->pessoa_fisica->pessoa_id;
                        $vendedorTipoPessoaId = TipoPessoa::getIdByTipo('VENDEDOR');
                        $service->deletePessoaTipoRelations($vendedorPessoaId, $vendedorTipoPessoaId);
                    }
                });
            }
            catch (QueryException $e)
            {
                Log::error('Erro ao tentar excluir relacionamento em Pessoas Tipos: ' . $e->getMessage());
                throw new \Exception('Houve um problema ao tentar excluir. Por favor, tente novamente.');
            }
            catch (\Exception $e)
            {
                Log::error('Erro inesperado: ' . $e->getMessage());
                throw new \Exception('Um erro inesperado ocorreu. Por favor, contate o suporte.');
            }
        });
    }
}
