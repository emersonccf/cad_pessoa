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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($distribuidor) {
            // Carregar a relação pessoa_juridica se não estiver carregada
            if (!$distribuidor->relationLoaded('pessoa_juridica')) {
                $distribuidor->load('pessoa_juridica');
            }

            // Verificar se a relação pessoa_juridica está presente
            if ($distribuidor->pessoa_juridica) {
                // Obter o ID da pessoa associada
                $pessoaId = $distribuidor->pessoa_juridica->pessoa_id;

                // Buscar dinamicamente o ID do tipo de pessoa usando cache
                $tipoPessoaId = TipoPessoa::getIdByTipo('DISTRIBUIDOR');

                // Criar um novo registro na tabela pessoas_tipos
                PessoaTipo::create([
                    'pessoa_id' => $pessoaId,
                    'tipo_pessoa_id' => $tipoPessoaId,
                ]);
            } else {
                // Lidar com o caso em que pessoa_juridica é nulo
                Log::warning('Pessoa jurídica não encontrada para Distribuidor ID: ' . $distribuidor->id);
            }
        });
    }
}
