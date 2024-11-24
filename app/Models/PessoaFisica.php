<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = 'pessoas_fisicas';
    protected $fillable = ['pessoa_id', 'cpf', 'rg', 'data_nascimento'];
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function cliente_pessoa_fisica()
    {
        return $this->hasOne(ClientePessoaFisica::class);
    }

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class);
    }

}
