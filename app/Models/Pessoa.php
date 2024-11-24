<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';
    protected $fillable = ['status_id', 'nome', 'logradouro', 'numero', 'bairro', 'cidade', 'uf', 'complemento', 'cep', 'ibge', 'telefone', 'celular', 'email'];
    public $timestamps = false;

    /* Relacionamento pertence-a com Status */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /* Relacionamento pertence-a-muitos com TipoPessoa */
    public function tipos_pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class, 'pessoas_tipos', 'pessoa_id', 'tipo_pessoa_id');
    }

    /* Relacionamento tem-um com PessoaFisica  */
    public function pessoa_fisica()
    {
        return $this->hasOne(PessoaFisica::class, 'pessoa_id');
    }

    /* Relacionamento tem-um com PessoaJuridica  */
    public function pessoa_juridica()
    {
        return $this->hasOne(PessoaJuridica::class, 'pessoa_id');
    }


}
