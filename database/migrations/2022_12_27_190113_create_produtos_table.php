<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('nome', 100);
            $table->text('descricao')->nullable(); //valor opcional
            $table->integer('peso')->nullable(); //valor opcional
            $table->float('preco_venda', 8,2)->default(0.01); //valor padrão
            $table->integer('estoque_minimo')->default(1); //valor padrão
            $table->integer('estoque_maximo')->default(1); //valor padrão
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
};
