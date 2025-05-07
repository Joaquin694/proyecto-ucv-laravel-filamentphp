<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaInvestigacionEspecifica extends Model
{
    protected $table = 'linea_investigacion_especifica';
    protected $primaryKey = 'id_linea_especifica';

    protected $fillable = [
        'nombre_linea_especifica'
    ];
}
