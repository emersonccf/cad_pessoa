<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $fillable = ['pessoa_juridica_id'];
    public $timestamps = false;

    public function pessoa_juridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($fornecedor) {
            // Carregar a relação pessoa_juridica se não estiver carregada
            if (!$fornecedor->relationLoaded('pessoa_juridica')) {
                $fornecedor->load('pessoa_juridica');
            }

            // Verificar se a relação pessoa_juridica está presente
            if ($fornecedor->pessoa_juridica) {
                // Obter o ID da pessoa associada
                $pessoaId = $fornecedor->pessoa_juridica->pessoa_id;

                // Buscar dinamicamente o ID do tipo de pessoa usando cache
                $tipoPessoaId = TipoPessoa::getIdByTipo('FORNECEDOR');

                // Criar um novo registro na tabela pessoas_tipos
                PessoaTipo::create([
                    'pessoa_id' => $pessoaId,
                    'tipo_pessoa_id' => $tipoPessoaId,
                ]);
            } else {
                // Lidar com o caso em que pessoa_juridica é nulo
                Log::warning('Pessoa jurídica não encontrada para Fornecedor ID: ' . $fornecedor->id);
            }
        });
    }
}
