<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientePessoaFisica extends Model
{
    protected $table = 'clientes_pessoas_fisicas';
    protected $fillable = ['pessoa_fisica_id', 'desconto'];
    public $timestamps = false;

    public function pessoa_fisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($clientePessoaFisica) {
            // Carregar a relação pessoa_fisica se não estiver carregada
            if (!$clientePessoaFisica->relationLoaded('pessoa_fisica')) {
                $clientePessoaFisica->load('pessoa_fisica');
            }

            // Verificar se a relação pessoa_fisica está presente
            if ($clientePessoaFisica->pessoa_fisica) {
                // Obter o ID da pessoa associada
                $pessoaId = $clientePessoaFisica->pessoa_fisica->pessoa_id;

                // Buscar dinamicamente o ID do tipo de pessoa usando cache
                $tipoPessoaId = TipoPessoa::getIdByTipo('CLIENTE PESSOA FÍSICA');

                // Criar um novo registro na tabela pessoas_tipos
                PessoaTipo::create([
                    'pessoa_id' => $pessoaId,
                    'tipo_pessoa_id' => $tipoPessoaId,
                ]);
            } else {
                // Lidar com o caso em que pessoa_fisica é nulo
                Log::warning('Pessoa física não encontrada para ClientePessoaFisica ID: ' . $clientePessoaFisica->id);
            }
        });
    }

}
