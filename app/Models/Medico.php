<?php

namespace App\Models;

use App\Services\PessoaTipoDeletionService;
use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = ['funcionario_id', 'crm'];
    public $timestamps = false;
    private static string $tipoPessoa = 'MÉDICO';

    public function funcionario()
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

        static::deleting(function ($model) use ($tipo_pessoa_loc)  {
            #TODO Trabalhar para abstrair toda essa rotina abaixo - teste ok
            $medicoId = $model->id;
            $medicoPessoaId = Medico::find($medicoId)->funcionario->pessoa_fisica->pessoa_id;
            $medicoTipoPessoaId = TipoPessoa::getIdByTipo($tipo_pessoa_loc);
            $service = new PessoaTipoDeletionService();
            $service->deletePessoaTipoRelations($medicoPessoaId, $medicoTipoPessoaId);
        });
    }


}
