<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaInvestigacionGeneralTable extends Migration
{
    public function up()
    {
        Schema::create('linea_investigacion_general', function (Blueprint $table) {
            $table->increments('id_linea_general');
            $table->string('nombre_linea_general', 200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('linea_investigacion_general');
    }
}
