@extends('adminlte::page')

@section('title', 'Formulário')

@section('content_header')
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Cadastro de Clientes</h3>
    </div>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(isset($cliente))
                        {!! Form::model($cliente,['url' => route('cliente.update' ,$cliente), 'method'=>'put','files' => 'true'])!!}
                    @else 
                        {!! Form::open(['url'=>route('cliente.store'),'files' => 'true'])!!}
                        
                    @endif

                    <div class="form-group">
                        {!! Form::label('nome', 'Nome')!!}
                        {!! Form::text('nome',null, ['class'=>'form-control', 'placeholder'=>'Informe o nome','required']) !!}
                        @error('nome') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('idade', 'Idade')!!}
                        {!! Form::number('idade',null, ['class'=>'form-control', 'placeholder'=>'Informe a idade ','required']) !!}
                        @error('idade') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('email', 'Email')!!}
                        {!! Form::text('email',null, ['class'=>'form-control', 'placeholder'=>'Informe o email ','required']) !!}
                        @error('email') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('cep', 'CEP')!!}
                        {!! Form::text('cep',null, ['class'=>'form-control','placeholder'=> 'Digite CEP','required']) !!}
                        @error('cep') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('logradouro', 'Logradouro')!!}
                        {!! Form::text('logradouro',null, ['class'=>'form-control', 'placeholder'=>'Logradouro','onfocusout'=>'buscaCep()','required']) !!}
                        @error('logradouro') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('bairro', 'Bairro')!!}
                        {!! Form::text('bairro',null, ['class'=>'form-control','placeholder'=>'Bairro','onfocusout'=>'buscaCep()','required']) !!}
                        @error('bairro') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('cidade', 'Cidade')!!}
                        {!! Form::text('cidade',null, ['class'=>'form-control','placeholder'=>'Cidade','onfocusout'=>'buscaCep()','required']) !!}
                        @error('cidade') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('estado', 'Estado')!!}
                        {!! Form::text('estado',null, ['class'=>'form-control','placeholder'=>'Estado','onfocusout'=>'buscaCep()','required']) !!}
                        @error('estado') <span class= "text-danger">{{ $message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('imagem_temp', 'Imagem') !!}
                        {!! Form::file('imagem_temp', ['class' => 'form-control', $cliente?? 'required']) !!}
                        @error('imagem_temp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('formacao_id', 'Formação') !!}
                        {!! Form::select('formacao_id',$formacao ?? null, ['class' => 'form-control']) !!}
                        @error('formacao_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="float-right mt-3">
                        {!! Form::button('Salvar &nbsp; <i class="fas fa-save"></i>', ['class' => 'btn btn-primary', "type" => "submit"]) !!}
                        <a href="{{ route("cliente.index") }}" class="btn btn-secondary">
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

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

     jQuery("#cep").mask("99999-999");

    function buscaCep()
    {
        let cep = document.getElementById('cep').value;
        let url = 'https://viacep.com.br/ws/'+ cep +'/json/';

        axios.get(url)
        .then(function(response){
            document.getElementById('logradouro').value=response.data.logradouro
            document.getElementById('bairro').value=response.data.bairro
            document.getElementById('cidade').value=response.data.localidade
            document.getElementById('estado').value=response.data.uf
        })

        .catch(function(error){
            alert('Ops ! CEP não encontrado' )
        })
    }
</script>
@stop
