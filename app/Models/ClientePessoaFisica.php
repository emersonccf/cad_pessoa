<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientePessoaFisica extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'clientes_pessoas_fisicas';
    protected $fillable = ['pessoa_fisica_id', 'desconto'];
    public $timestamps = false;
    private static string $tipoPessoa  = 'CLIENTE PESSOA FÍSICA';

    public function pessoa_fisica() : BelongsTo
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    protected static function boot()
    {
        parent::boot();
        $tipo_pessoa_loc = static::$tipoPessoa;

        static::created(function ($model) use ($tipo_pessoa_loc) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica', $tipo_pessoa_loc);
        });

        static::deleting(function ($model) use ($tipo_pessoa_loc) {
            #TODO Trabalhar para abstrair toda essa rotina abaixo - teste ok
            $clientePessoaFisicaId = $model->id;
            $pessoaId = ClientePessoaFisica::find($clientePessoaFisicaId)->load('pessoa_fisica')->pessoa_fisica->pessoa_id;
            $tipoPessoaId = TipoPessoa::getIdByTipo($tipo_pessoa_loc); // Obter o tipo_pessoa_id dinamicamente
            $service = new PessoaTipoDeletionService();
            $service->deletePessoaTipoRelations($pessoaId, $tipoPessoaId);
        });
    }

}
