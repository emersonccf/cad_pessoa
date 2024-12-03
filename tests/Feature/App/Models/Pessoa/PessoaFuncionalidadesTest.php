<?php

namespace Tests\Feature\App\Models\Pessoa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PessoaFuncionalidadesTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();

        // Executa a seeder específica usando Artisan
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\TipoPessoaSeeder', '--env' => 'testing']);
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\StatusSeeder', '--env' => 'testing']);
    }

    public function test_criacao_de_pessoa()
    {
        // Passo 1: Definir dados válidos para uma nova pessoa
        $dadosPessoa = [
            'status_id' => 1,
            'nome' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'logradouro' => 'Rua das Flores',
            'numero' => '123',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01000-000',
            'telefone' => '11999999999',
        ];

        // Passo 2: Enviar uma requisição para criar a pessoa e Incluir o token CSRF na requisição
        $response = $this->post(route('pessoas.store'), $dadosPessoa, ['X-CSRF-TOKEN' => csrf_token()]);

        // Passo 3: Verificar se a resposta HTTP está correta (ex: 302 Found)
        $response->assertStatus(302);
        $response->assertRedirect(route('pessoas.index')); //e se o redirecionamento foi para a página index de pessoas

        // Passo 4: Verificar se a pessoa foi salva no banco de dados
        $this->assertDatabaseHas('pessoas', [
            'nome' => 'João Silva',
            'email' => 'joao.silva@example.com',
        ]);

        // Verificar se o redirecionamento ocorreu para a rota correta
        $response->assertRedirect(route('pessoas.index'));

    }
}
