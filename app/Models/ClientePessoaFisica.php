<?php

namespace App\Models;

use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class ClientePessoaFisica extends Model
{
    protected $table = 'clientes_pessoas_fisicas';
    protected $fillable = ['pessoa_fisica_id', 'desconto'];
    public $timestamps = false;

    public function pessoa_fisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica', 'CLIENTE PESSOA FÍSICA');
        });
    }

}
