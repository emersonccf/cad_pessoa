<?php

namespace App\Models;

use App\Services\PessoaTipoService;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['pessoa_fisica_id', 'data_admissao'];
    public $timestamps = false;

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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            PessoaTipoService::createPessoaTipo($model, 'pessoa_fisica', 'FUNCIONÁRIO');
        });
    }

}
