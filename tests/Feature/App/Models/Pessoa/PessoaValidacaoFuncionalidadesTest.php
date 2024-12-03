<?php

namespace Tests\Feature\App\Models\Pessoa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PessoaValidacaoFuncionalidadesTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function test_campos_obrigatorios_nao_fornecidos()
    {
        // Dados incompletos, omitindo campos obrigatórios
        $dadosIncompletos = [
            // 'status_id' está ausente
            'nome' => '', // Campo obrigatório vazio
            'email' => '',
            // Outros campos podem estar presentes ou ausentes, conforme necessário
        ];

        // Enviar requisição para criar uma pessoa
        $response = $this->post(route('pessoas.store'), $dadosIncompletos);

        // Verificar se a resposta HTTP é 302, indicando redirecionamento devido a falha de validação
        $response->assertStatus(302);

        // Verificar se os erros de validação são retornados para os campos obrigatórios
        $response->assertSessionHasErrors([
            'status_id',
            'nome',
            'email',
        ]);
    }

}
