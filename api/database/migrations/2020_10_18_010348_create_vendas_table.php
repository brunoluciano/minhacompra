<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('funcionario_id')->nullable();
            $table->unsignedBigInteger('entregador_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->dateTime('horario');
            $table->integer('qtd_itens');
            $table->double('total_venda');

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('funcionario_id')->references('id')->on('usuarios');
            $table->foreign('entregador_id')->references('id')->on('usuarios');
            $table->foreign('status_id')->references('id')->on('status_vendas');

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
        Schema::dropIfExists('vendas');
    }
}
