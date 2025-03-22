<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoInvestigacion extends Model
{
    protected $table = 'producto_investigacion';
    protected $primaryKey = 'id_producto';
    public $timestamps = true;

    protected $fillable = [
        'id_tipo_producto',
        'titulo_producto',
        'id_estado',
        'id_cuartil',
        'doi_url',
        'fecha_publicacion',
        'id_linea_general',
        'id_linea_especifica',
        'principal_resultado',
        'pdf_nombre',
        'pdf_file',
    ];

    // Relación con TipoProductoInvestigacion
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProductoInvestigacion::class, 'id_tipo_producto');
    }

    // Relación con EstadoInvestigacion
    public function estadoInvestigacion()
    {
        return $this->belongsTo(EstadoInvestigacion::class, 'id_estado');
    }

    // Relación con CuartilInvestigacion
    public function cuartilInvestigacion()
    {
        return $this->belongsTo(CuartilInvestigacion::class, 'id_cuartil');
    }

    // Relación con LineaInvestigacionGeneral
    public function lineaInvestigacionGeneral()
    {
        return $this->belongsTo(LineaInvestigacionGeneral::class, 'id_linea_general');
    }

    // Relación con LineaInvestigacionEspecifica
    public function lineaInvestigacionEspecifica()
    {
        return $this->belongsTo(LineaInvestigacionEspecifica::class, 'id_linea_especifica');
    }

    // Relación con Autores (muchos a muchos)
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'autor_producto', 'id_producto', 'id_autor')
                    ->withPivot('rol_autor')
                    ->withTimestamps();
    }
}
