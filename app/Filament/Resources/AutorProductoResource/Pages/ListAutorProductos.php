<?php

namespace App\Filament\Resources\AutorProductoResource\Pages;

use App\Filament\Resources\AutorProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAutorProductos extends ListRecords
{
    protected static string $resource = AutorProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
