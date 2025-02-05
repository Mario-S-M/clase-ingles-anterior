<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NivelesIngles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('niveles_ingles', function (Blueprint $table) {
            $table->bigIncrements('id_nivel_ingles');
            $table->string('nombre_nivel');    
            $table->timestamps();
        });

        Schema::create('niveles_ingles_users', function (Blueprint $table) {
            
            $table->bigIncrements('niveles_ingles_users');

            $table->unsignedBigInteger('enrol_nivel_ingles')->nullable();
            $table->foreign('enrol_nivel_ingles')->references('id_nivel_ingles')->on('niveles_ingles');
      
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');

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
        //
    }
}
