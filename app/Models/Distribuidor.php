<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $table = 'distribuidores';

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }
}
