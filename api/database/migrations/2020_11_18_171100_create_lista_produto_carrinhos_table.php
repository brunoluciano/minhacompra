<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaProdutoCarrinhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_produto_carrinhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('carrinho_id');
            $table->integer('quantidade')->default(0);
            $table->double('total')->default(0);

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('carrinho_id')->references('id')->on('carrinhos');

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
        Schema::dropIfExists('lista_produto_carrinhos');
    }
}
