<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaJuridica extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'pessoas_juridicas';
    protected $fillable = ['pessoa_id', 'razao_social', 'cnpj', 'rg_ie', 'tipo_contribuinte', 'isento_ie_estadual', 'responsavel'];
    public $timestamps = false;

    public function pessoa() : BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function cliente_pessoa_juridica() : HasOne
    {
        return $this->hasOne(ClientePessoaJuridica::class, 'pessoa_juridica_id');
    }

    public function fornecedor() : HasOne
    {
        return $this->hasOne(Fornecedor::class, 'pessoa_juridica_id');
    }

    public function distribuidor() : HasOne
    {
        return $this->hasOne(Distribuidor::class, 'pessoa_juridica_id');
    }
}
