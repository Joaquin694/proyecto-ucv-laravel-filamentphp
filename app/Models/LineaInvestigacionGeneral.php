<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaInvestigacionGeneral extends Model
{
    protected $table = 'linea_investigacion_general';
    protected $primaryKey = 'id_linea_general';
    public $timestamps = true;

    protected $fillable = [
        'nombre_linea_general',
    ];

    // Relación con ProductoInvestigacion (uno a muchos)
    public function productosInvestigacion()
    {
        return $this->hasMany(ProductoInvestigacion::class, 'id_linea_general');
    }
}
