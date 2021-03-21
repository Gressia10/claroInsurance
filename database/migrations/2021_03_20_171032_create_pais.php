<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pais', function (Blueprint $table) {
            $table->string('PaisCodigo', 3)->primary();
            $table->string('PaisNombre', 52)->nullable(false)->default('');
            $table->string('PaisContinente', 50)->nullable(false)->default('Asia');
            $table->string('PaisRegion', 26)->nullable(false)->default('');
            $table->decimal('PaisArea', 52)->nullable(false)->default('0.00');
            $table->integer('PaisIndependencia')->nullable(true)->default(null);
            $table->integer('PaisPoblacion')->nullable(false)->default(0);
            $table->decimal('PaisExpectativaDeVida')->nullable(true)->default(null);
            $table->decimal('PaisProductoInternoBruto')->nullable(true)->default(null);
            $table->decimal('PaisProductoInternoBrutoAntiguo')->nullable(true)->default(null);
            $table->string('PaisNombreLocal', 45)->nullable(false)->default('');
            $table->string('PaisGobierno', 45)->nullable(false)->default('');
            $table->string('PaisJefeDeEstado', 26)->nullable(false)->default('');
            $table->integer('PaisCapital')->nullable(true)->default(null);
            $table->string('PaisCodigo2', 2)->nullable(false)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pais');
    }
}
