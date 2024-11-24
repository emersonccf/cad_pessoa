<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = ['funcionario_id', 'crm'];
    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($medico) {
            // Carregar a relação funcionario se não estiver carregada
            if (!$medico->relationLoaded('funcionario')) {
                $medico->load('funcionario');
            }

            // Verificar se a relação funcionario está presente
            if ($medico->funcionario) {
                // Carregar a relação pessoa_fisica se não estiver carregada
                if (!$medico->funcionario->relationLoaded('pessoa_fisica')) {
                    $medico->funcionario->load('pessoa_fisica');
                }

                // Verificar se a relação pessoa_fisica está presente
                if ($medico->funcionario->pessoa_fisica) {
                    // Obter o ID da pessoa associada
                    $pessoaId = $medico->funcionario->pessoa_fisica->pessoa_id;

                    // Buscar dinamicamente o ID do tipo de pessoa usando cache
                    $tipoPessoaId = TipoPessoa::getIdByTipo('MÉDICO');

                    // Criar um novo registro na tabela pessoas_tipos
                    PessoaTipo::create([
                        'pessoa_id' => $pessoaId,
                        'tipo_pessoa_id' => $tipoPessoaId,
                    ]);
                } else {
                    // Lidar com o caso em que pessoa_fisica é nulo
                    Log::warning('Pessoa física não encontrada para Funcionario ID: ' . $medico->funcionario->id);
                }
            } else {
                // Lidar com o caso em que funcionario é nulo
                Log::warning('Funcionario não encontrado para Medico ID: ' . $medico->id);
            }
        });
    }

}
