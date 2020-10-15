<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->char('cnpj',14)->unique();
            $table->string('logo_url')->nullable();
            $table->string('telefone');
            $table->string('endereco');
            $table->integer('numero');
            $table->string('complemento')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
