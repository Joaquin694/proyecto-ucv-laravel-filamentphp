<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProductoInvestigacion extends Model
{
    protected $table = 'tipo_producto_investigacion';
    protected $primaryKey = 'id_tipo_producto';
    public $timestamps = true;

    protected $fillable = [
        'nombre_tipo_producto',
    ];

    // Relación con ProductoInvestigacion (uno a muchos)
    public function productosInvestigacion()
    {
        return $this->hasMany(ProductoInvestigacion::class, 'id_tipo_producto');
    }
}
