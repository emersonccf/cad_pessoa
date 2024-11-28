<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class ClientePessoaJuridica extends Model
{
    protected $table = 'clientes_pessoas_juridicas';
    protected $fillable = ['pessoa_juridica_id'];
    public $timestamps = false;
    private static string $tipoPessoa = 'CLIENTE PESSOA JURÍDICA';

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }

    protected static function boot()
    {
        parent::boot();
        $tipo_pessoa_loc = static::$tipoPessoa;

        static::created(function ($model) use ($tipo_pessoa_loc) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_juridica', $tipo_pessoa_loc);
        });

        static::deleting(function ($model) use ($tipo_pessoa_loc) {
            #TODO Trabalhar para abstrair toda essa rotina abaixo
            $clientePessoaJuridicaId = $model->id;
            $pessoaId = ClientePessoaJuridica::find($clientePessoaJuridicaId)->load('pessoa_juridica')->pessoa_juridica->pessoa_id;
            $tipoPessoaId = TipoPessoa::getIdByTipo($tipo_pessoa_loc); // Obter o tipo_pessoa_id dinamicamente
            $service = new PessoaTipoDeletionService();
            $service->deletePessoaTipoRelations($pessoaId, $tipoPessoaId);
        });
    }
}
