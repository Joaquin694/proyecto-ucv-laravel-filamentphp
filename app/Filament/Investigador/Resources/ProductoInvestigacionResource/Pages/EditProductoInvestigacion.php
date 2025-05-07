<?php

namespace App\Filament\Investigador\Resources\ProductoInvestigacionResource\Pages;

use App\Filament\Investigador\Resources\ProductoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductoInvestigacion extends EditRecord
{
    protected static string $resource = ProductoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
