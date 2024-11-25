<?php

namespace App\Models;

use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = ['funcionario_id', 'comissao'];
    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica.funcionario', 'VENDEDOR');
        });
    }

}
