<?php

namespace App\Http\Controllers;

use App\Formacao;
use Illuminate\Http\Request;
use App\DataTables\FormacaoDataTable;
use App\Services\FormacaoService;
use App\Http\Requests\FormacaoRequest;

class FormacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormacaoDataTable $formacaoDataTable)
    {
        return $formacaoDataTable->render('formacao.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formacao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormacaoRequest $request)
    {
        $retorno = FormacaoService::store($request->all());
        if ($retorno['status']) {
            
            return redirect()->route('formacao.index');
        }
        
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Formacao  $formacao
     * @return \Illuminate\Http\Response
     */
    public function show(Formacao $formacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Formacao  $formacao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retorno = FormacaoService::getFormacaoPorId($id);
        if ($retorno['status']) {
            return view('formacao.create', [
                'formacao' => $retorno['formacao'],
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formacao  $formacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $retorno = FormacaoService::update($request->all(), $id);
        if ($retorno['status']) {
            return redirect()->route('formacao.index');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Formacao  $formacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retorno = FormacaoService::destroy($id);
        if ($retorno['status']) {
            return "Sucesso";
        }
        return abort(403, 'Erro ao Excuir ' .$retorno['erro']);
    }
}
