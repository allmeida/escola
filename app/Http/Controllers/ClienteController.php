<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Formacao;
use Illuminate\Http\Request;
use App\DataTables\ClienteDataTable;
use App\Http\Requests\ClienteRequest;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    public function index(ClienteDataTable $clienteDataTable)
    {
        return $clienteDataTable->render('cliente.index');
    }

    public function create()
    {
        $formacao = Formacao::all()->pluck('nome', 'id');
        return view('cliente.create', compact('formacao'));
    }

    public function store(ClienteRequest $request)
    { 
        $cliente = ClienteService::store($request->all());
        //dd($request->all());
        if ($cliente['status']){
          return redirect()->route('cliente.index');
        }
        return back()->withInput()
                ->withFalha('Ocorreu um erro ao salvar');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retorno = ClienteService::getClientePorId($id);

        if($retorno ['status']){
            return view('cliente.create', [
                'formacao' => $retorno['formacao'],
                'cliente' => $retorno['cliente'],
            ]);
        }   
        return back()->withFalha('Ocorreu um erro ao selecionar o cliente'); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $retorno = ClienteService::update($request->all(), $id);
         if ($retorno['status']){
             return redirect()->route('cliente.index');
         }
         return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retorno = ClienteService::destroy($id);
        if ($retorno['status']){
            return "Sucesso";
        }
        return abort(403,'Erro ao Excluir' .$retorno['erro']);
    }
}
