<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProductoInvestigacion extends Model
{
    protected $table = 'tipo_producto_investigacion';
    protected $primaryKey = 'id_tipo_producto';

    protected $fillable = [
        'nombre_tipo_producto'
    ];
}
