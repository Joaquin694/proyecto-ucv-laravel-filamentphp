<?php

namespace App\Filament\Resources\AutorProductoResource\Pages;

use App\Filament\Resources\AutorProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutorProducto extends EditRecord
{
    protected static string $resource = AutorProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
