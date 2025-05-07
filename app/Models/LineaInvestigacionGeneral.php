<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaInvestigacionGeneral extends Model
{
    protected $table = 'linea_investigacion_general';
    protected $primaryKey = 'id_linea_general';

    protected $fillable = [
        'nombre_linea_general'
    ];
}
