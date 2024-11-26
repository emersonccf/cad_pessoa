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

    public function getDefinedRelations()
    {
        return [
            'pf_cpf' => 'pessoa_fisica.cliente_pessoa_fisica',
            'pf_f' => 'pessoa_fisica.funcionario',
            'pf_f_m' => 'pessoa_fisica.funcionario.medico',
            'pf_f_v' => 'pessoa_fisica.funcionario.vendedor',
            'pj_cpj' => 'pessoa_juridica.cliente_pessoa_juridica',
            'pj_f' => 'pessoa_juridica.fornecedor',
            'pj_d' => 'pessoa_juridica.distribuidor',
            // Novas relações podem ser adicionadas aqui ou criado um arquivo a parte de onde podem ser carregados estes relacionamentos
        ];
    }

    public function saveAll()
    {
        $service = new PessoaService($this);
        $service->saveAll();
    }

}
