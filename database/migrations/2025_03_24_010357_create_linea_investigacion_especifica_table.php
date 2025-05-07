<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaInvestigacionEspecificaTable extends Migration
{
    public function up()
    {
        Schema::create('linea_investigacion_especifica', function (Blueprint $table) {
            $table->increments('id_linea_especifica');
            $table->string('nombre_linea_especifica', 200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('linea_investigacion_especifica');
    }
}
