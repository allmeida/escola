<?php

use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false
]);

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::resource('cliente', 'ClienteController');
    Route::resource('formacao', 'FormacaoController');
});

Route::get('/home', 'HomeController@index')->name('home');