<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class ClientePessoaFisica extends Model
{
    protected $table = 'clientes_pessoas_fisicas';
    protected $fillable = ['pessoa_fisica_id', 'desconto'];
    public $timestamps = false;
    protected $tipoPessoa = 'CLIENTE PESSOA FÍSICA';

    public function pessoa_fisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica', $this->tipoPessoa);
        });

        static::deleting(function ($cliente_pessoa_fisica) {
            $pessoaId = ClientePessoaFisica::find($cliente_pessoa_fisica->id)->load('pessoa_fisica')->pessoa_fisica->pessoa_id;
            $tipoPessoaId = TipoPessoa::getIdByTipo($this->tipoPessoa); // Obter o tipo_pessoa_id dinamicamente
            $service = new PessoaTipoDeletionService();
            $service->deletePessoaTipoRelations($pessoaId, $tipoPessoaId);
        });
    }

}
