<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AutorProducto extends Pivot
{
    protected $table = 'autor_producto';

    protected $fillable = [
        'id_autor',
        'id_producto',
        'rol_autor',
    ];

    /**
     * Accesor para simular un id único (concatenando id_autor e id_producto).
     */
    /**
     * Relación con el modelo Autor.
     */
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'id_autor');
    }

    /**
     * Relación con el modelo ProductoInvestigacion.
     */
    public function productoInvestigacion()
    {
        return $this->belongsTo(ProductoInvestigacion::class, 'id_producto');
    }
}
