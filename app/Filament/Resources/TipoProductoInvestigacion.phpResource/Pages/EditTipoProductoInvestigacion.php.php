<?php

namespace App\Filament\Resources\TipoProductoInvestigacion.phpResource\Pages;

use App\Filament\Resources\TipoProductoInvestigacion.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoProductoInvestigacion.php extends EditRecord
{
    protected static string $resource = TipoProductoInvestigacion.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
