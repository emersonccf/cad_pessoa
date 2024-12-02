<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PessoaFisica extends Model
{
    protected $table = 'pessoas_fisicas';
    protected $fillable = ['pessoa_id', 'cpf', 'rg', 'data_nascimento'];
    public $timestamps = false;

    public function pessoa() : BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function cliente_pessoa_fisica() : HasOne
    {
        return $this->hasOne(ClientePessoaFisica::class);
    }

    public function funcionario() : HasOne
    {
        return $this->hasOne(Funcionario::class);
    }

}
