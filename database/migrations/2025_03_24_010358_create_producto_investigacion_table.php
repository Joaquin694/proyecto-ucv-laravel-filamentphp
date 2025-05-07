<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoInvestigacionTable extends Migration
{
    public function up()
    {
        Schema::create('producto_investigacion', function (Blueprint $table) {
            $table->increments('id_producto');
            $table->unsignedInteger('id_tipo_producto');
            $table->string('titulo_producto', 255)->unique();
            $table->unsignedInteger('id_estado');
            $table->unsignedInteger('id_cuartil')->nullable();
            $table->string('doi_url', 255)->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->unsignedInteger('id_linea_general')->nullable();
            $table->unsignedInteger('id_linea_especifica')->nullable();
            $table->unsignedInteger('id_grado')->nullable();
            // Nuevo campo para el autor principal:
            $table->unsignedInteger('id_autor_principal')->nullable();
            $table->text('principal_resultado')->nullable();
            $table->string('pdf_nombre', 255)->nullable();
            $table->timestamps();

            // Claves foráneas existentes:
            $table->foreign('id_tipo_producto')->references('id_tipo_producto')->on('tipo_producto_investigacion');
            $table->foreign('id_estado')->references('id_estado')->on('estado_investigacion');
            $table->foreign('id_cuartil')->references('id_cuartil')->on('cuartil_investigacion');
            $table->foreign('id_linea_general')->references('id_linea_general')->on('linea_investigacion_general');
            $table->foreign('id_linea_especifica')->references('id_linea_especifica')->on('linea_investigacion_especifica');
            $table->foreign('id_grado')->references('id_grado')->on('grados');
            // Nueva clave foránea para el autor principal:
            $table->foreign('id_autor_principal')->references('id_autor')->on('autores');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_investigacion');
    }
}
