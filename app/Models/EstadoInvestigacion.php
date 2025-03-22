<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoInvestigacion extends Model
{
    protected $table = 'estado_investigacion';
    protected $primaryKey = 'id_estado';
    public $timestamps = true;

    protected $fillable = [
        'nombre_estado',
    ];

    // Relación con ProductoInvestigacion (uno a muchos)
    public function productosInvestigacion()
    {
        return $this->hasMany(ProductoInvestigacion::class, 'id_estado');
    }
}
