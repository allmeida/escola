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
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($formacao) {
                $acoes = link_to(
                    route('formacao.edit' , $formacao),
                    'Editar',
                    ['class' => 'btn btn-sm btn-primary']
                );
                $acoes .= FormFacade::button(
                    'Excluir',
                    [
                        'class' => 'btn btn-sm btn-danger',
                        'onclick' => "excluir('" .route('formacao.destroy', $formacao) ."')"
                    ]
                );
                return $acoes;
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Formacao $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
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
