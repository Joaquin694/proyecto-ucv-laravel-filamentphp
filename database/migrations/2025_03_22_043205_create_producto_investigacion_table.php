<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoInvestigacionTable extends Migration
{
    public function up()
    {
        Schema::create('producto_investigacion', function (Blueprint $table) {
            $table->increments('id_producto');
            $table->unsignedInteger('id_tipo_producto');
            $table->string('titulo_producto', 255);
            $table->unsignedInteger('id_estado');
            $table->unsignedInteger('id_cuartil')->nullable();
            $table->string('doi_url', 255)->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->unsignedInteger('id_linea_general')->nullable();
            $table->unsignedInteger('id_linea_especifica')->nullable();
            $table->text('principal_resultado')->nullable();
            $table->string('pdf_nombre', 255)->nullable();
            $table->string('pdf_file', 255)->nullable();
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('id_tipo_producto')
                  ->references('id_tipo_producto')
                  ->on('tipo_producto_investigacion');
            $table->foreign('id_estado')
                  ->references('id_estado')
                  ->on('estado_investigacion');
            $table->foreign('id_cuartil')
                  ->references('id_cuartil')
                  ->on('cuartil_investigacion');
            $table->foreign('id_linea_general')
                  ->references('id_linea_general')
                  ->on('linea_investigacion_general');
            $table->foreign('id_linea_especifica')
                  ->references('id_linea_especifica')
                  ->on('linea_investigacion_especifica');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_investigacion');
    }
}
