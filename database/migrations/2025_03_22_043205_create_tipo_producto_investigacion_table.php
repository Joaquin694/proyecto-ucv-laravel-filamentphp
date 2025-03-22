<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoProductoInvestigacionTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_producto_investigacion', function (Blueprint $table) {
            $table->increments('id_tipo_producto');
            $table->string('nombre_tipo_producto', 100);
            $table->timestamps(); // opcional
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_producto_investigacion');
    }
}
