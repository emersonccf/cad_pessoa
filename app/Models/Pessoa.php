<?php

namespace App\Models;

use App\Services\PessoaService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';
    protected $fillable = ['status_id', 'nome', 'logradouro', 'numero', 'bairro', 'cidade', 'uf', 'complemento', 'cep', 'ibge', 'telefone', 'celular', 'email'];
    public $timestamps = false;

    /* Relacionamento pertence-a com Status */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /* Relacionamento pertence-a-muitos com TipoPessoa */
    public function tipos_pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class, 'pessoas_tipos', 'pessoa_id', 'tipo_pessoa_id');
    }

    /* Relacionamento tem-um com PessoaFisica  */
    public function pessoa_fisica()
    {
        return $this->hasOne(PessoaFisica::class, 'pessoa_id');
    }

    /* Relacionamento tem-um com PessoaJuridica  */
    public function pessoa_juridica()
    {
        return $this->hasOne(PessoaJuridica::class, 'pessoa_id');
    }

    /* ====================================== relacionamentos: tem um através de ===================================== */

    public function cliente_pessoa_fisica()
    {
        return $this->hasOneThrough(ClientePessoaFisica::class, PessoaFisica::class, 'pessoa_id', 'pessoa_fisica_id');
    }

    public function funcionario()
    {
        return $this->hasOneThrough(Funcionario::class, PessoaFisica::class, 'pessoa_id', 'pessoa_fisica_id');
    }

    public function medico()
    {
        return $this->hasOneThrough(Medico::class, Funcionario::class, 'pessoa_fisica_id', 'funcionario_id');
    }

    public function vendedor()
    {
        return $this->hasOneThrough(Vendedor::class, Funcionario::class, 'pessoa_fisica_id', 'funcionario_id');
    }

    public function cliente_pessoa_juridica()
    {
        return $this->hasOneThrough(ClientePessoaJuridica::class, PessoaJuridica::class, 'pessoa_id', 'pessoa_juridica_id');
    }

    public function fornecedor()
    {
        return $this->hasOneThrough(Fornecedor::class, PessoaJuridica::class, 'pessoa_id', 'pessoa_juridica_id');
    }

    public function distribuidor()
    {
        return $this->hasOneThrough(Distribuidor::class, PessoaJuridica::class, 'pessoa_id', 'pessoa_juridica_id');
    }

    /* =============================================================================================================== */

    public function getDefinedRelations()
    {
        return [
            'pessoa_fisica.cliente_pessoa_fisica',
            'pessoa_fisica.funcionario',
            'pessoa_fisica.funcionario.medico',
            'pessoa_fisica.funcionario.vendedor',
            'pessoa_juridica.cliente_pessoa_juridica',
            'pessoa_juridica.fornecedor',
            'pessoa_juridica.distribuidor',
            // Novas relações podem ser adicionadas aqui ou criado um arquivo a parte de onde podem ser carregados estes relacionamentos
        ];
    }

    public function saveAll()
    {
        $service = new PessoaService($this);
        $service->saveAll();
    }

}
