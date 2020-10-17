<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('unidade_medida_id');
            $table->double('unidade');
            $table->string('cod_barras');
            $table->integer('estoque_minimo');
            $table->integer('estoque_atual');
            $table->integer('estoque_maximo');
            $table->double('preco');
            $table->string('imagem_url')->nullable();
            $table->boolean('promocao_ativa')->default(false);

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('departamento_id')->references('id')->on('departamento_produtos');
            $table->foreign('categoria_id')->references('id')->on('categoria_produtos');
            $table->foreign('marca_id')->references('id')->on('marca_produtos');
            $table->foreign('unidade_medida_id')->references('id')->on('unidade_medida_produtos');

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
        Schema::dropIfExists('produtos');
    }
}
