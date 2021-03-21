<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ciudad', function (Blueprint $table) {
            $table->integer('CiudadId')->nullable(false)->primary();
            $table->string('CiudadNombre', 35)->nullable(false)->default('');
            $table->string('PaisCodigo', 3)->nullable(false);
            $table->string('CiudadDistrito', 20)->nullable(false)->default('');
            $table->integer('CiudadPoblacion')->nullable(false)->default(0);

            $table->foreign('PaisCodigo')->references('PaisCodigo')->on('Pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Ciudad');
    }
}
