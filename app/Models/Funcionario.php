<?php

namespace App\Models;

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

        static::created(function ($funcionario) {
            // Carregar a relação pessoa_fisica se não estiver carregada
            if (!$funcionario->relationLoaded('pessoa_fisica')) {
                $funcionario->load('pessoa_fisica');
            }

            // Verificar se a relação pessoa_fisica está presente
            if ($funcionario->pessoa_fisica) {
                // Obter o ID da pessoa associada
                $pessoaId = $funcionario->pessoa_fisica->pessoa_id;

                // Buscar dinamicamente o ID do tipo de pessoa usando cache
                $tipoPessoaId = TipoPessoa::getIdByTipo('FUNCIONÁRIO');

                // Criar um novo registro na tabela pessoas_tipos
                PessoaTipo::create([
                    'pessoa_id' => $pessoaId,
                    'tipo_pessoa_id' => $tipoPessoaId,
                ]);
            } else {
                // Lidar com o caso em que pessoa_fisica é nulo
                Log::warning('Pessoa física não encontrada para Funcionario ID: ' . $funcionario->id);
                // Opcionalmente, lançar uma exceção ou tomar outra ação
            }
        });
    }

}
