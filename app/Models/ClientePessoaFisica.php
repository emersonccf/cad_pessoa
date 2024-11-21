<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientePessoaFisica extends Model
{
    protected $table = 'clientes_pessoas_fisicas';

    public function pessoa_fisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

}
