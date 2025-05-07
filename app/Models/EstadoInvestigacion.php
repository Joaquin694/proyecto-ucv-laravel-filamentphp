<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoInvestigacion extends Model
{
    protected $table = 'estado_investigacion';
    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'nombre_estado'
    ];
}
