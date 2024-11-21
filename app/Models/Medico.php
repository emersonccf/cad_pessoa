<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
