<?php

namespace Tests\Feature\App\Models\Pessoa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoaFuncionalidadesTeste extends TestCase
{
    use RefreshDatabase, WithFaker;

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

        // Passo 2: Enviar uma requisição para criar a pessoa
        $response = $this->post('/pessoas', $dadosPessoa);

        // Passo 3: Verificar se a resposta HTTP está correta (ex: 201 Created)
        $response->assertStatus(201);

        // Passo 4: Verificar se a pessoa foi salva no banco de dados
        $this->assertDatabaseHas('pessoas', [
            'nome' => 'João Silva',
            'email' => 'joao.silva@example.com',
        ]);
    }
}
