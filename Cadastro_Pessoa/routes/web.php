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


