<?php

namespace Tests\Feature\App\Models\Pessoa;

use App\Models\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PessoaDeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        // Executa a seeder específica usando Artisan
//        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\StatusSeeder', '--env' => 'testing']);
//        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\TipoPessoaSeeder', '--env' => 'testing']);
//    }

    public function test_deve_excluir_logicamente_uma_pessoa()
    {
        // Criação de uma instância de Pessoa
        $pessoa = Pessoa::factory()->create();

        // Verifica se a pessoa está presente no banco de dados
        $this->assertDatabaseHas('pessoas', ['id' => $pessoa->id]);

        // Realiza a exclusão lógica
        $pessoa->delete();

        // Verifica se a pessoa foi excluída logicamente
        $this->assertSoftDeleted('pessoas', ['id' => $pessoa->id]);

        // Verifica se a pessoa ainda existe no banco de dados como excluída logicamente
        $this->assertNotNull(Pessoa::withTrashed()->find($pessoa->id));
    }


    public function test_deve_excluir_fisicamente_uma_pessoa()
    {
        // Criação de uma instância de Pessoa
        $pessoa = Pessoa::factory()->create();

        // Verifica se a pessoa está presente no banco de dados
        $this->assertDatabaseHas('pessoas', ['id' => $pessoa->id]);

        // Realiza a exclusão física
        $pessoa->forceDelete();

        // Verifica se a pessoa foi excluída fisicamente
        $this->assertDatabaseMissing('pessoas', ['id' => $pessoa->id]);

        // Verifica que a pessoa não existe mais, nem mesmo como excluída logicamente
        $this->assertNull(Pessoa::withTrashed()->find($pessoa->id));
    }

    public function test_excluir_logicamente_uma_pessoa_atraves_do_controller()
    {
        // Criação de uma instância de Pessoa
        $pessoa = Pessoa::factory()->create();

        // Verifica se a pessoa está presente no banco de dados
        $this->assertDatabaseHas('pessoas', ['id' => $pessoa->id]);

        // Simula a requisição para o método de exclusão lógica
        $response = $this->delete(route('pessoas.delete_logico', $pessoa->id));

        // Verifica se a resposta está correta (ex: 302 found)
        $response->assertStatus(302);
        $response->assertRedirect(route('pessoas.index')); //e se o redirecionamento foi para a página index de pessoas

        // Verifica se a pessoa foi excluída logicamente
        $this->assertSoftDeleted('pessoas', ['id' => $pessoa->id]);

        // Verifica se a pessoa ainda existe no banco de dados como excluída logicamente
        $this->assertNotNull(Pessoa::withTrashed()->find($pessoa->id));
    }

    public function test_excluir_fisicamente_uma_pessoa_atraves_do_controller()
    {
        // Criação de uma instância de Pessoa
        $pessoa = Pessoa::factory()->create();

        // Verifica se a pessoa está presente no banco de dados
        $this->assertDatabaseHas('pessoas', ['id' => $pessoa->id]);

        // Simula a requisição para o método de exclusão física
        $response = $this->delete(route('pessoas.destroy', $pessoa->id));

        // Verifica se a resposta está correta (ex: 302 found)
        $response->assertStatus(302);
        $response->assertRedirect(route('pessoas.index')); //e se o redirecionamento foi para a página index de pessoas

        // Verifica se a pessoa foi excluída fisicamente
        $this->assertDatabaseMissing('pessoas', ['id' => $pessoa->id]);

        // Verifica que a pessoa não existe mais, nem mesmo como excluída logicamente
        $this->assertNull(Pessoa::withTrashed()->find($pessoa->id));
    }

}
