<?php

namespace App\Models;

use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class ClientePessoaJuridica extends Model
{
    protected $table = 'clientes_pessoas_juridicas';
    protected $fillable = ['pessoa_juridica_id'];
    public $timestamps = false;

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_juridica', 'CLIENTE PESSOA JURÍDICA');
        });
    }
}
