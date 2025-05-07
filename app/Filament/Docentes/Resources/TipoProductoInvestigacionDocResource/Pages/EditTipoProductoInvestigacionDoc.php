<?php

namespace App\Filament\Docentes\Resources\TipoProductoInvestigacionDocResource\Pages;

use App\Filament\Docentes\Resources\TipoProductoInvestigacionDocResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoProductoInvestigacionDoc extends EditRecord
{
    protected static string $resource = TipoProductoInvestigacionDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
