<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientePessoaJuridica extends Model
{
    protected $table = 'clientes_pessoas_juridicas';
    protected $fillable = [];
    public $timestamps = false;

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }
}
