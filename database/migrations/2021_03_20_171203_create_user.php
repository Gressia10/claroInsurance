<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            //     
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();
            
            

            // $table->integer('id')->primary();

            $table->bigIncrements('id');
            $table->integer('type')->nullable(false)->default(0);
            $table->string('name', 100)->nullable(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->timestamps();

            $table->string('number', 10)->nullable(true)->default(null);
            $table->string('ci', 20)->nullable(false)->default('');
            $table->date('date')->nullable(false)->useCurrent();

            // $table->string('PaisCodigo', 3)->nullable(false);
            // $table->foreign('PaisCodigo')->references('PaisCodigo')->on('Pais');

            // $table->integer('CiudadId')->nullable(false);
            // $table->foreign('CiudadId')->references('CiudadId')->on('Ciudad');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
