<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaTipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'pessoas_tipos';
    protected $fillable = ['pessoa_id', 'tipo_pessoa_id'];
    public $timestamps = false;

    protected static function boot(): void
    {
        parent::boot();

        // Adicionando um listener de evento para o evento de criação
        static::creating(function ($model) {
            $model->numeracao = self::max('numeracao') + 1; // PessoaTipo::max('campo') função do Eloquente
        });
    }
}
