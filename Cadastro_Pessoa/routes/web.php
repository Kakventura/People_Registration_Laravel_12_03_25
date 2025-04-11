<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pessoa;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('inicio');
});

Route::post('/cadastrar-pessoa', function (Request $request) {

    $validated = $request->validate([
        'nome' => 'required|string',
        'telefone' => 'required|string',
        'origem' => 'required|in:1,2,3',
        'data_contato' => 'required|date',
        'comentarios' => 'nullable|string'
    ]);

    if ($validated) {
        Pessoa::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'origem' => $request->origem,
            'data_contato' => $request->data_contato,
            'comentarios' => $request->comentarios
        ]);
        return view('pessoaCadastrada');
    } else {
        // Exibir os erros
        return back()->withErrors($validated);
    }
});

//Listagem de cadastros
Route::get('/listar-pessoas', function () {
    $pessoas = Pessoa::all();
    return view('listarPessoas', ['pessoas' => $pessoas]);
});

Route::get('/editar-pessoa/{id}', function ($id) {
    $pessoa = Pessoa::find($id);

    if (!$pessoa) {
        abort(404, 'Pessoa não encontrada.');
    }

    return view('edicaoPessoas', ['pessoa' => $pessoa]);  // A variável aqui é $pessoa, não $pessoas.
});

Route::post('/atualizar-pessoa/{id}', function (Request $request, $id) {
    $pessoa = Pessoa::find($id);

    if (!$pessoa) {
        abort(404, 'Pessoa não encontrada.');
    }

    $pessoa->update([
        'nome' => $request->nome,
        'telefone' => $request->telefone,
        'origem' => $request->origem,
        'data_contato' => $request->data_contato,
        'comentarios' => $request->comentarios
    ]);

    return redirect('/listar-pessoas')->with('success', 'Pessoa atualizada com sucesso!');
});

// Exclusão de pessoa
Route::delete('/excluir-pessoa/{id}', function ($id) {
    $pessoa = Pessoa::find($id);

    if (!$pessoa) {
        abort(404, 'Pessoa não encontrada.');
    }

    $pessoa->delete();

    return redirect('/listar-pessoas')->with('success', 'Pessoa excluída com sucesso!');
});




