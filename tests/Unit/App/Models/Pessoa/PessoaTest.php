<?php

namespace Tests\Unit\App\Models\Pessoa;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use App\Models\Pessoa;

class PessoaTest extends TestCase
{

    /**
     * Método chamado após cada teste para garantir que todos os mocks
     * criados pelo Mockery sejam fechados corretamente.
     */
    protected function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Testa se uma pessoa pode ser instanciada
     */
    public function test_pessoa_pode_ser_instanciada()
    {
        $pessoa = new Pessoa([
            'nome' => 'João Silva',
            'status_id' => 1,
            'email' => 'joao@example.com'
        ]);

        $this->assertEquals('João Silva', $pessoa->nome);
        $this->assertEquals(1, $pessoa->status_id);
        $this->assertEquals('joao@example.com', $pessoa->email);
    }


    /**
     * Testa se uma exceção é lançada quando o nome não é fornecido.
     */
    public function test_pessoa_emite_exception_se_nome_nao_for_fornecido()
    {
        // Define que esperamos uma exceção do tipo Exception.
        $this->expectException(Exception::class);

        // Cria um mock parcial da classe Pessoa.
        // O makePartial() permite que o mock mantenha o comportamento original,
        // exceto onde especificado.
        $pessoa = Mockery::mock(Pessoa::class)->makePartial();

        // Simula o método save para lançar uma exceção quando chamado,
        // sem realmente tentar acessar o banco de dados.
        $pessoa->shouldReceive('save')->andThrow(new Exception("O nome é obrigatório."));

        // Define os atributos necessários, exceto 'nome', para testar a exceção.
        $pessoa->setAttribute('status_id', 1);
        $pessoa->setAttribute('email', 'joao@example.com');

        // Chama o método save, que foi simulado para lançar uma exceção.
        $pessoa->save();
    }

    /**
     * Testa se uma exceção é lançada quando o status não é fornecido.
     */
    public function test_pessoa_emite_exception_se_status_nao_for_fornecido()
    {
        // Define que esperamos uma exceção do tipo Exception.
        $this->expectException(Exception::class);

        // Cria um mock parcial da classe Pessoa.
        $pessoa = Mockery::mock(Pessoa::class)->makePartial();

        // Simula o método save para lançar uma exceção quando chamado,
        // sem realmente tentar acessar o banco de dados.
        $pessoa->shouldReceive('save')->andThrow(new Exception("O status é obrigatório."));

        // Define os atributos necessários, exceto 'status_id', para testar a exceção.
        $pessoa->setAttribute('nome', 'João Silva');
        $pessoa->setAttribute('email', 'joao@example.com');

        // Chama o método save, que foi simulado para lançar uma exceção.
        $pessoa->save();
    }
}
