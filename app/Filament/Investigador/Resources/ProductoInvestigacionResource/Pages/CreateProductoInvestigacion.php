<?php

namespace App\Filament\Investigador\Resources\ProductoInvestigacionResource\Pages;

use App\Filament\Investigador\Resources\ProductoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\AutorProducto;


class CreateProductoInvestigacion extends CreateRecord
{
    protected static string $resource = ProductoInvestigacionResource::class;

    protected function afterCreate(): void
    {
        $producto = $this->record;

        if (Auth::check() && Auth::user()->id_autor) {
            AutorProducto::create([
                'id_autor' => Auth::user()->id_autor,
                'id_producto' => $producto->id_producto,
                'rol_autor' => 'Principal',
            ]);
        }
    }
}
