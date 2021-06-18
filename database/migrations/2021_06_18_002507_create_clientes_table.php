<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome',150);
            $table->integer('idade');
            $table->string('email')->unique();
            $table->string('cep',9);
            $table->string('logradouro');
            $table->string('bairro',100);
            $table->string('cidade',100);
            $table->string('estado',70);
            $table->text('imagem')->nullable();
            $table->unsignedBigInteger('formacao_id');

            $table->timestamps();

            $table->foreign('formacao_id')->references('id')->on('formacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
