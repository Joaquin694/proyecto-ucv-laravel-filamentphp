<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $primaryKey = 'id_grado';

    protected $fillable = [
        'tipo',
        'curso',
        'ciclo'
    ];
}
