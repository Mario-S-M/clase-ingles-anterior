<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('leccion', function (Blueprint $table) {
            $table->bigIncrements('id_leccion');
            $table->string('titulo_leccion');  
            $table->string('descripcion');   
            $table->foreignId("clv_nivel_ingles")->references("id_nivel_ingles")->on("niveles_ingles");  
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
