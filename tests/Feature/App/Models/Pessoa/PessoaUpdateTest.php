<?php

namespace Tests\Feature\App\Models\Pessoa;

use App\Models\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PessoaUpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();

        // Executa a seeder específica usando Artisan
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\TipoPessoaSeeder', '--env' => 'testing']);
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\StatusSeeder', '--env' => 'testing']);
    }

    public function test_atualizacao_de_pessoa()
    {
        // Passo 1: Criar uma pessoa existente para atualizar
        $pessoa = Pessoa::factory()->create([
            'status_id' => 1,
            'nome' => 'João Silva',
            'email' => 'joao.silva@example.com',
        ]);

        // Passo 2: Definir os novos dados para atualização
        $dadosAtualizados = [
            'nome' => 'João Maria da Silva',
            'email' => 'joao.maria.da.silva@example.com',
        ];

        // Passo 3: Enviar uma requisição para atualizar a pessoa
        $response = $this->put(route('pessoas.update', $pessoa), $dadosAtualizados);

        // Passo 4: Verificar se a resposta HTTP está correta (ex: 200 OK)
        $response->assertStatus(200);

        // Passo 5: Verificar se os dados da pessoa foram atualizados no banco de dados
        $this->assertDatabaseHas('pessoas', [
            'id' => $pessoa->id,
            'nome' => 'João Maria da Silva',
            'email' => 'joao.maria.da.silva@example.com',
        ]);
    }
}
