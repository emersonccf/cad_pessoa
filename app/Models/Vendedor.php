<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = ['funcionario_id', 'comissao'];
    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
