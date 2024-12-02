<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = ['funcionario_id', 'comissao'];
    public $timestamps = false;
    private static string $tipoPessoa = 'VENDEDOR';

    public function funcionario() : BelongsTo
    {
        return $this->belongsTo(Funcionario::class);
    }

    protected static function boot()
    {
        parent::boot();
        $tipo_pessoa_loc = static::$tipoPessoa;

        static::created(function ($model) use ($tipo_pessoa_loc) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica.funcionario', $tipo_pessoa_loc);
        });

        static::deleting(function ($model) use ($tipo_pessoa_loc) {
            #TODO Trabalhar para abstrair toda essa rotina abaixo - teste ok
            $vendedorId = $model->id;
            $medicoPessoaId = Vendedor::find($vendedorId)->funcionario->pessoa_fisica->pessoa_id;
            $medicoTipoPessoaId = TipoPessoa::getIdByTipo($tipo_pessoa_loc);
            $service = new PessoaTipoDeletionService();
            $service->deletePessoaTipoRelations($medicoPessoaId, $medicoTipoPessoaId);
        });

    }

}
