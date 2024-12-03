<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaFisica extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
