<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table = 'pessoas_juridicas';
    protected $fillable = ['pessoa_id', 'razao_social', 'cnpj', 'rg_ie', 'tipo_contribuinte', 'isento_ie_estadual', 'responsavel'];
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function cliente_pessoa_juridica()
    {
        return $this->hasOne(ClientePessoaJuridica::class, 'pessoa_juridica_id');
    }

    public function fornecedor()
    {
        return $this->hasOne(Fornecedor::class, 'fornecedor_id');
    }

    public function distribuidor()
    {
        return $this->hasOne(Distribuidor::class, 'distribuidor_id');
    }
}
