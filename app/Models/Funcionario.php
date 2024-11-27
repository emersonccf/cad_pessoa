<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['pessoa_fisica_id', 'data_admissao'];
    public $timestamps = false;

    protected $tipoPessoa = 'FUNCIONÁRIO';

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

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica', $this->tipoPessoa);
        });

        static::deleting(function ($funcionario) {
            $service = new PessoaTipoDeletionService();

            // Deletar relação do próprio Funcionário
            $pessoaId = Funcionario::find($funcionario->id)->load('pessoa_fisica')->pessoa_fisica->pessoa_id;
            $tipoPessoaId = TipoPessoa::getIdByTipo($this->tipoPessoa);
            $service->deletePessoaTipoRelations($pessoaId, $tipoPessoaId);

            // Deletar relação do Médico, se existir
            if ($funcionario->medico) {
                $medicoPessoaId = $funcionario->medico->funcionario->pessoa_fisica->pessoa_id;
                $medicoTipoPessoaId = TipoPessoa::getIdByTipo('MÉDICO');
                $service->deletePessoaTipoRelations($medicoPessoaId, $medicoTipoPessoaId);
            }

            // Deletar relação do Vendedor, se existir
            if ($funcionario->vendedor) {
                $vendedorPessoaId = $funcionario->vendedor->funcionario->pessoa_fisica->pessoa_id;
                $vendedorTipoPessoaId = TipoPessoa::getIdByTipo('VENDEDOR');
                $service->deletePessoaTipoRelations($vendedorPessoaId, $vendedorTipoPessoaId);
            }
        });

    }
}
