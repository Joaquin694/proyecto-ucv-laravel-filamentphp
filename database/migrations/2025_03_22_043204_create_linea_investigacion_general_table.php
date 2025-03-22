<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaInvestigacionGeneralTable extends Migration
{
    public function up()
    {
        Schema::create('linea_investigacion_general', function (Blueprint $table) {
            $table->increments('id_linea_general');
            $table->string('nombre_linea_general', 200);
            $table->timestamps(); // opcional
        });
    }

    public function down()
    {
        Schema::dropIfExists('linea_investigacion_general');
    }
}
