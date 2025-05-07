<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuartilInvestigacion extends Model
{
    protected $table = 'cuartil_investigacion';
    protected $primaryKey = 'id_cuartil';

    protected $fillable = [
        'nombre_cuartil'
    ];
}
