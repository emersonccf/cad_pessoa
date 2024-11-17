<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PessoaTipo extends Model
{
    /** @use HasFactory<\Database\Factories\PessoaTipoFactory> */
    use HasFactory;

    protected $table = 'pessoas_tipos';

    protected static function boot()
    {
        parent::boot();

        // Adicionando um listener de evento para o evento de criação
        static::creating(function ($model) {
            $model->numeracao = self::max('numeracao') + 1;
        });
    }
}
