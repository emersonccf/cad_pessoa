<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $table = 'distribuidores';
    protected $fillable = ['pessoa_juridica_id'];
    public $timestamps = false;

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }
}
