<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->char('cpf', 11)->unique();
            $table->char('sexo', 1);
            $table->date('nascimento');
            $table->string('telefone');
            $table->string('endereco');
            $table->integer('numero');
            $table->string('complemento');
            $table->string('cidade');
            $table->unsignedBigInteger('estado_id');
            $table->string('bairro');
            $table->char('cep', 8);

            $table->foreign('estado_id')->references('id')->on('estados');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
