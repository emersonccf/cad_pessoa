<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}