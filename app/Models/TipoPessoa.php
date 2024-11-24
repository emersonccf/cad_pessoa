<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TipoPessoa extends Model
{
    use HasFactory;

    protected $table = 'tipos_pessoas';
    protected $fillable = ['tipo', 'descricao'];
    public $timestamps = false;

    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class);
    }

    /* Método para obter o ID do tipo de pessoa pelo nome, com cache */
    public static function getIdByTipo(string $tipo)
    {
        // Define a chave do cache
        $cacheKey = 'tipo_pessoa_id_' . $tipo;

        // Tenta obter o ID do cache
        return Cache::remember($cacheKey, 60, function () use ($tipo) {
            // Se não estiver no cache, busca no banco de dados
            return self::where('tipo', $tipo)->value('id');
        });
    }
}
