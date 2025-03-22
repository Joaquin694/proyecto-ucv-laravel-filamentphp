<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuartilInvestigacionTable extends Migration
{
    public function up()
    {
        Schema::create('cuartil_investigacion', function (Blueprint $table) {
            $table->increments('id_cuartil');
            $table->string('nombre_cuartil', 10);
            $table->timestamps(); // opcional
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuartil_investigacion');
    }
}
