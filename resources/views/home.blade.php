@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div>
                <h1>FRANCINILDO DE FREITAS ALMEIDA</h1>
                <h2>Analista de Sistemas  •  Programador Web</h2>
            </div>
            <hr />
            <div class="btn">
                <a href="https://www.linkedin.com/in/francinildoalmeida" target="_blanck" class="btn btn-rounded btn-blue" >Linkedin</a>
                
                <a href="https://github.com/allmeida/escola" target="_blanck" class="btn btn-rounded btn-blue" >Github</a>
            </div>
        </div>
    </div> 
</div>

@stop

@section('content')
    
@stop

@section('css')
@stop

@section('js')
@stop

<style>
    
.container {
text-align:center;
}

.container h1 {
    color: #314584;
    font-weight: bold;
    padding-top: 20px;
    padding-bottom: 40px;
    text-transform: uppercase;
}

.container h2 {
    color: #314584;
    padding-top: 10px;
    padding-bottom: 30px;
}

.btn {
    text-align:center;
    margin-right: 20px;
}

.btn.btn-rounded.btn-blue {
    background-color: #007bff;
    border-radius: 15px;
    color: #fff;
    padding: 5px 20px;
}

.btn.btn-rounded.btn-blue:hover {
    background-color: #fff;
    color: #007bff;
    border: 1px solid #007bff;
}
</style>