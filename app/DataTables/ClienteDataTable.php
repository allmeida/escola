<?php

namespace App\DataTables;

use App\Cliente;
use App\Formacao;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClienteDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('action', function($cliente){
            $acoes = link_to(
                route('cliente.edit', $cliente),
                'Editar',
                ['class' => 'btn btn-sm btn-primary']
            );
            $acoes .= FormFacade::button(
                'Excluir',
                [
                    'class' => 'btn btn-sm btn-danger',
                    'onclick' => "excluir('" .route('cliente.destroy', $cliente) ."')"
                ]
            );    
            return $acoes;
        })
        
        ->editColumn('created_at', function ($cliente){
            return date('d/m/Y', strtotime($cliente->created_at));
        })
        ->editColumn('formacao_id', function($cliente){
            return Formacao::find($cliente->formacao_id)->nome;
        })
        ->editColumn('imagem', function ($cliente) {
            return '<img style="height: 50px;" src="' . asset('imagens/' . $cliente->imagem) . '" />';
        })
        ->rawColumns(['action', 'imagem']);
        
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Cliente $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cliente $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('cliente-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Novo Cliente')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('nome'),
            Column::make('created_at')
            ->title('Data de Entrada'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Cliente_' . date('YmdHis');
    }
}
