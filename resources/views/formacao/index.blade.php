@extends('adminlte::page')

@section('title', 'Formação')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="container">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Lista de Formação</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    {!! $dataTable->scripts() !!}
@stop
