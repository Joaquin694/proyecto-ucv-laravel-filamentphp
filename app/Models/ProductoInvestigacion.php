<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductoInvestigacion extends Model
{
    protected $table = 'producto_investigacion';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_tipo_producto',
        'titulo_producto',
        'id_estado',
        'id_cuartil',
        'doi_url',
        'fecha_publicacion',
        'id_linea_general',
        'id_linea_especifica',
        'id_grado',
        'principal_resultado',
        'pdf_nombre'
    ];

    // Relaciones existentes...
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProductoInvestigacion::class, 'id_tipo_producto');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoInvestigacion::class, 'id_estado');
    }

    public function cuartil()
    {
        return $this->belongsTo(CuartilInvestigacion::class, 'id_cuartil');
    }

    public function lineaGeneral()
    {
        return $this->belongsTo(LineaInvestigacionGeneral::class, 'id_linea_general');
    }

    public function lineaEspecifica()
    {
        return $this->belongsTo(LineaInvestigacionEspecifica::class, 'id_linea_especifica');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    // Relación general con autores usando el pivote personalizado.
    public function autores()
    {
        return $this->belongsToMany(
            Autor::class,
            'autor_producto',
            'id_producto',
            'id_autor'
        )->using(AutorProducto::class)
         ->withPivot('rol_autor');
    }

    // Relación para obtener el autor principal (único)
    public function autorPrincipal()
    {
        return $this->belongsToMany(
            Autor::class,
            'autor_producto',
            'id_producto',
            'id_autor'
        )->using(AutorProducto::class)
         ->withPivot('rol_autor')
         ->wherePivot('rol_autor', 'Principal')
         ->limit(1);
    }

    // Relación para obtener los coautores (pueden ser varios)
    public function coautores()
    {
        return $this->belongsToMany(
            Autor::class,
            'autor_producto',
            'id_producto',
            'id_autor'
        )->using(AutorProducto::class)
         ->withPivot('rol_autor')
         ->wherePivot('rol_autor', 'Coautor');
    }

    // Accessor para obtener la URL completa del PDF
    public function getPdfUrlAttribute()
    {
        return $this->pdf_nombre ? asset('storage/' . $this->pdf_nombre) : null;
    }

    // Hook para eliminar el archivo PDF al borrar el registro
    protected static function booted()
    {
        static::deleting(function ($producto) {
            if ($producto->pdf_nombre && Storage::disk('public')->exists($producto->pdf_nombre)) {
                Storage::disk('public')->delete($producto->pdf_nombre);
            }
        });
    }
}
