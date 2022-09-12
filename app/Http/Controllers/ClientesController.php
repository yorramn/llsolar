<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\clientes;

class ClientesController extends Controller
{
    public function create(){

        return view('clientes.create');

    }

    public function store(Request $request){

       Clientes::create([
        'nome' => $request->nome,
        'cpf' => $request->cpf,
        'telefone' => $request->telefone,
        'email' => $request->email,
        'cep' => $request->cep,
        'logradouro' => $request->logradouro,
        'bairro' => $request->bairro,
        'cidade' => $request->cidade,
        'estado' => $request->estado,
        'numero' => $request->numero,
        'complemento' => $request->complemento,

    ]);

        return "Cliente Criado com Sucesso!";
        
    
}
}
