<?php

namespace App\Http\Controllers;

use App\Formacao;
use Illuminate\Http\Request;
use App\DataTables\FormacaoDataTable;
use App\Services\FormacaoService;
use App\Http\Requests\FormacaoRequest;

class FormacaoController extends Controller
{
    public function index(FormacaoDataTable $formacaoDataTable)
    {
        return $formacaoDataTable->render('formacao.index');
    }

    public function create()
    {
        return view('formacao.create');
    }

    public function store(FormacaoRequest $request)
    {
        $retorno = FormacaoService::store($request->all());
        if ($retorno['status']) {
            
            return redirect()->route('formacao.index');
        }
        
        return back()->withInput();
    }

    public function show(Formacao $formacao)
    {
        //
    }

    public function edit($id)
    {
        $retorno = FormacaoService::getFormacaoPorId($id);
        if ($retorno['status']) {
            return view('formacao.create', [
                'formacao' => $retorno['formacao'],
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $retorno = FormacaoService::update($request->all(), $id);
        if ($retorno['status']) {
            return redirect()->route('formacao.index');
        }

        return back()->withInput();
    }

    public function destroy($id)
    {
        $retorno = FormacaoService::destroy($id);
        if ($retorno['status']) {
            return "Sucesso";
        }
        return abort(403, 'Erro ao Excuir ' .$retorno['erro']);
    }
}
