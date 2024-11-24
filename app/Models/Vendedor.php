<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = ['funcionario_id', 'comissao'];
    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($vendedor) {
            // Carregar a relação funcionario se não estiver carregada
            if (!$vendedor->relationLoaded('funcionario')) {
                $vendedor->load('funcionario');
            }

            // Verificar se a relação funcionario está presente
            if ($vendedor->funcionario) {
                // Carregar a relação pessoa_fisica se não estiver carregada
                if (!$vendedor->funcionario->relationLoaded('pessoa_fisica')) {
                    $vendedor->funcionario->load('pessoa_fisica');
                }

                // Verificar se a relação pessoa_fisica está presente
                if ($vendedor->funcionario->pessoa_fisica) {
                    // Obter o ID da pessoa associada
                    $pessoaId = $vendedor->funcionario->pessoa_fisica->pessoa_id;

                    // Buscar dinamicamente o ID do tipo de pessoa usando cache
                    $tipoPessoaId = TipoPessoa::getIdByTipo('VENDEDOR');

                    // Criar um novo registro na tabela pessoas_tipos
                    PessoaTipo::create([
                        'pessoa_id' => $pessoaId,
                        'tipo_pessoa_id' => $tipoPessoaId,
                    ]);
                } else {
                    // Lidar com o caso em que pessoa_fisica é nulo
                    Log::warning('Pessoa física não encontrada para Funcionario ID: ' . $vendedor->funcionario->id);
                }
            } else {
                // Lidar com o caso em que funcionario é nulo
                Log::warning('Funcionario não encontrado para Vendedor ID: ' . $vendedor->id);
            }
        });
    }
}
