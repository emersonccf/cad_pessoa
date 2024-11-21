<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tipos_pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class);
    }

    public function pessoa_fisica()
    {
        return $this->hasOne(PessoaFisica::class);
    }

    public function pessoa_juridica()
    {
        return $this->hasOne(PessoaJuridica::class);
    }


}
