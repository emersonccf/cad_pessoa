<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';
    protected $fillable = [];
    public $timestamps = false;

    /* Metodo estatico para criar uma nova pessoa */
    public static function createWithAttributes(array $attributes)
    {
        return self::create($attributes);
    }

    /* Relacionamento pertence-a com Status */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /* Relacionamento pertence-a-muitos com TipoPessoa */
    public function tipos_pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class);
    }

    /* Relacionamento tem-um com PessoaFisica  */
    public function pessoa_fisica()
    {
        return $this->hasOne(PessoaFisica::class);
    }

    /* Relacionamento tem-um com PessoaJuridica  */
    public function pessoa_juridica()
    {
        return $this->hasOne(PessoaJuridica::class);
    }


}
