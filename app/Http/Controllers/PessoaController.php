<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd("Index { success }");

        return view('pessoas.pessoa-index', compact('pessoa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validação dos Dados
        $validatedData = $request->validate([
            'status_id' => 'required|integer|exists:status,id',
            'nome' => 'required|string|max:80',
            'email' => 'required|email|max:100|unique:pessoas,email',
            'logradouro' => 'nullable|string|max:80',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:50',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|size:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:20',
        ]);

        // 2. Criação e Salvamento usando Atribuição em Massa
        Pessoa::create($validatedData);

        // 3. Redirecionamento com Mensagem de Sucesso
        return redirect()->route('pessoas.index')->with('success', 'Pessoa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        //
    }
}
