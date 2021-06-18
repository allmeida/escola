@extends('adminlte::page')

@section('title', 'Formulário')

@section('content_header')
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Cadastro de Formação </h3>
    </div>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (isset($formacao))
                        {!! Form::model($formacao, ['route' => ['formacao.update', $formacao], 'method' => 'put']) !!}
                    @else
                    {!! Form::open(['url' => route('formacao.store')]) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('nome', 'Nome')!!}
                        {!! Form::text('nome',null, ['class'=>'form-control', 'placeholder'=>'Informe o mome','required']) !!}
                        @error('nome') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="float-right mt-3">
                        {!! Form::button('Salvar &nbsp; <i class="fas fa-save"></i>', ['class' => 'btn btn-primary', "type" => "submit"]) !!}
                        <a href="{{ route("formacao.index") }}" class="btn btn-secondary">
                            Voltar &nbsp;<i class="fas fa-reply"></i>
                        </a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
