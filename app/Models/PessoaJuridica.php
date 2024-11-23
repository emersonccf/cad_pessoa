<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table = 'pessoas_juridicas';
    protected $fillable = [];
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function cliente_pessoa_juridica()
    {
        return $this->hasOne(ClientePessoaJuridica::class);
    }

    public function fornecedor()
    {
        return $this->hasOne(Fornecedor::class);
    }

    public function distribuidor()
    {
        return $this->hasOne(Distribuidor::class);
    }
}
