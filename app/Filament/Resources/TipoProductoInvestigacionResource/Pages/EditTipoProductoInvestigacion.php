<?php

namespace App\Filament\Resources\TipoProductoInvestigacionResource\Pages;

use App\Filament\Resources\TipoProductoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoProductoInvestigacion extends EditRecord
{
    protected static string $resource = TipoProductoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
