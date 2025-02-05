<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeccionesPagina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('secciones_pagina', function (Blueprint $table) {
            $table->bigIncrements('id_seccion_pagina');
            $table->foreignId("clv_pagina_leccion")->references("id_pagina_leccion")->on("pagina_leccion");
            $table->text('imagen'); 
            $table->text('descripcion_imagen');  
            $table->text('contenido'); 
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
