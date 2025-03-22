<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuartilInvestigacion extends Model
{
    protected $table = 'cuartil_investigacion';
    protected $primaryKey = 'id_cuartil';
    public $timestamps = true;

    protected $fillable = [
        'nombre_cuartil',
    ];

    // Relación con ProductoInvestigacion (uno a muchos)
    public function productosInvestigacion()
    {
        return $this->hasMany(ProductoInvestigacion::class, 'id_cuartil');
    }
}
