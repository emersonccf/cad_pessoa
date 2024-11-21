<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    public function pessoa_fisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    public function vendedor()
    {
        return $this->hasOne(Vendedor::class);
    }

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

}
