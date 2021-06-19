<?php

namespace App\DataTables;

use App\Formacao;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FormacaoDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($formacao) {
                $acoes = [
                    [
                        "titulo" => "Editar",
                        "icone" => "fas fa-edit",
                        "route" => route('formacao.edit', $formacao),
                        "class" => "btn btn-sm btn-primary",
                        "tipo" => "link"
                    ],
                    [
                        "titulo" => "Excluir",
                        "tipo" => "button",
                        "icone" => "fas fa-trash-alt",
                        "onclick" => "excluir('" . route('formacao.destroy', $formacao) ."')"
                    ]
                ];
       
                return view("datatable.acoes", compact("acoes"));
            });

    }

    public function query(Formacao $model)
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
                    ->setTableId('formacao-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Nova Formação &nbsp;<i class="fas fa-plus"></i>')
                        ->addClass("botao-datatable")
                    )
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false,
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json']
                    ]);
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
            Column::computed('action')
                  ->exportable(false)
                  ->title('Ações')
                  ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Formacao_' . date('YmdHis');
    }
}
