<?php

namespace App\Models;
use Filament\Models\Contracts\HasName;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Autor extends Authenticatable implements HasName
{
    protected $table = 'autores';
    protected $primaryKey = 'id_autor';

    protected $fillable = [
        'nombre_autor',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function productos()
    {
        return $this->belongsToMany(
            ProductoInvestigacion::class,
            'autor_producto',
            'id_autor',
            'id_producto'
        )->using(AutorProducto::class)
         ->withPivot('rol_autor');
    }
    public function getFilamentName(): string
    {
        return $this->nombre_autor ?? 'Nombre no disponible';
    }
}
