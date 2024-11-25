<?php

namespace App\Models;

use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = ['funcionario_id', 'crm'];
    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica.funcionario', 'MÉDICO');
        });
    }


}
