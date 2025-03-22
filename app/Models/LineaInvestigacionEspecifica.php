<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaInvestigacionEspecifica extends Model
{
    protected $table = 'linea_investigacion_especifica';
    protected $primaryKey = 'id_linea_especifica';
    public $timestamps = true;

    protected $fillable = [
        'nombre_linea_especifica',
    ];

    // Relación con ProductoInvestigacion (uno a muchos)
    public function productosInvestigacion()
    {
        return $this->hasMany(ProductoInvestigacion::class, 'id_linea_especifica');
    }
}
