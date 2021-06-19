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
        if ($cliente['status']){
          return redirect()->route('cliente.index');
        }
        return back()->withInput()
                ->withFalha('Ocorreu um erro ao salvar');
        
    }

    public function show(Cliente $cliente)
    {
        //
    }

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

    public function update(Request $request,$id)
    {
        $retorno = ClienteService::update($request->all(), $id);
         if ($retorno['status']){
             return redirect()->route('cliente.index');
         }
         return back()->withInput();
    }

    public function destroy($id)
    {
        $retorno = ClienteService::destroy($id);
        if ($retorno['status']){
            return "Sucesso";
        }
        return abort(403,'Erro ao Excluir' .$retorno['erro']);
    }
}
