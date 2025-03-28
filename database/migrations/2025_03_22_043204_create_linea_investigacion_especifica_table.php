<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaInvestigacionEspecificaTable extends Migration
{
    public function up()
    {
        Schema::create('linea_investigacion_especifica', function (Blueprint $table) {
            $table->increments('id_linea_especifica');
            $table->string('nombre_linea_especifica', 200);
            $table->timestamps(); // opcional
        });
    }

    public function down()
    {
        Schema::dropIfExists('linea_investigacion_especifica');
    }
}
