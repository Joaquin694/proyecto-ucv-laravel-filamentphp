<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    // Especifica la tabla y la llave primaria personalizada
    protected $table = 'autores';
    protected $primaryKey = 'id_autor';

    // Si no usas timestamps, deshabilita esta opción
    public $timestamps = true;

    // Atributos asignables en masa
    protected $fillable = [
        'nombre_autor',
        'email',
        'password',
        'role',
    ];

    // Relación con ProductoInvestigacion (muchos a muchos)
    public function productosInvestigacion()
    {
        return $this->belongsToMany(ProductoInvestigacion::class, 'autor_producto', 'id_autor', 'id_producto')
                    ->withPivot('rol_autor')
                    ->withTimestamps();
    }
}
