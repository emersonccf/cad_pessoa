<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Retorne true se o usuário estiver autorizado a fazer esta requisição
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Verifica se o método HTTP é POST (criação) ou PUT/PATCH (atualização)
        $rules =  [
            //'status_id' => 'required|integer|exists:status,id',
            'nome' => 'required|string|max:80',
            'email' => 'required|email|max:100|unique:pessoas,email',
            'logradouro' => 'nullable|string|max:80',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:50',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|size:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:20',
            //'cpf' => ['nullable', new ValidarCpf], // Aplicando a regra de validação CPF
            //'cnpj' => ['nullable', new ValidarCnpj], // Aplicando a regra de validação CNPJ
        ];

        // Adiciona a regra 'status_id' apenas se for uma requisição de criação
        if ($this->isMethod('post')) {
            $rules['status_id'] = 'required|integer|exists:status,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'status_id.required' => 'O campo status é obrigatório.',
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.unique' => 'Este endereço de e-mail já está em uso.',
            // outras mensagens personalizadas
        ];
    }
}
