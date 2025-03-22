<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoInvestigacionTable extends Migration
{
    public function up()
    {
        Schema::create('estado_investigacion', function (Blueprint $table) {
            $table->increments('id_estado');
            $table->string('nombre_estado', 50);
            $table->timestamps(); // opcional
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_investigacion');
    }
}
