<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaginaLeccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pagina_leccion', function (Blueprint $table) {
            $table->bigIncrements('id_pagina_leccion');
            $table->string('titulo');  
            $table->text('link_video_frame');  
            $table->text('link_cuestonario');    
            $table->foreignId("clv_leccion")->references("id_leccion")->on("leccion");  
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
