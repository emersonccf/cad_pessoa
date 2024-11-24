<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientePessoaJuridica extends Model
{
    protected $table = 'clientes_pessoas_juridicas';
    protected $fillable = ['pessoa_juridica_id'];
    public $timestamps = false;

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($clientePessoaJuridica) {
            // Carregar a relação pessoa_juridica se não estiver carregada
            if (!$clientePessoaJuridica->relationLoaded('pessoa_juridica')) {
                $clientePessoaJuridica->load('pessoa_juridica');
            }

            // Verificar se a relação pessoa_juridica está presente
            if ($clientePessoaJuridica->pessoa_juridica) {
                // Obter o ID da pessoa associada
                $pessoaId = $clientePessoaJuridica->pessoa_juridica->pessoa_id;

                // Buscar dinamicamente o ID do tipo de pessoa usando cache
                $tipoPessoaId = TipoPessoa::getIdByTipo('CLIENTE PESSOA JURÍDICA');

                // Criar um novo registro na tabela pessoas_tipos
                PessoaTipo::create([
                    'pessoa_id' => $pessoaId,
                    'tipo_pessoa_id' => $tipoPessoaId,
                ]);
            } else {
                // Lidar com o caso em que pessoa_juridica é nulo
                Log::warning('Pessoa jurídica não encontrada para ClientePessoaJuridica ID: ' . $clientePessoaJuridica->id);
            }
        });
    }
}
