<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePessoaRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoas = Pessoa::with(['status', 'tipos_pessoas'])->get();

        return view('pessoas.pessoa-index', compact('pessoas'));
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
    public function store(StorePessoaRequest $request)
    {
        // 1. Validação dos Dados
        $validatedData = $request->validated();

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
    public function update(StorePessoaRequest $request, Pessoa $pessoa)
    {
        // 1. Validação dos Dados
        $validatedData = $request->validated();

        // Passo 2: Encontrar a pessoa pelo ID
        // $pessoa = Pessoa::findOrFail($id);

        // 2. Atualiza valores
        $pessoa->update($validatedData);

        // 3. Redirecionamento com Mensagem de Sucesso
        return redirect()->route('pessoas.index')->with('success', 'Pessoa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        //
    }
}
