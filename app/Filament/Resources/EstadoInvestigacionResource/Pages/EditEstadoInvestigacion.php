<?php

namespace App\Filament\Resources\EstadoInvestigacionResource\Pages;

use App\Filament\Resources\EstadoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstadoInvestigacion extends EditRecord
{
    protected static string $resource = EstadoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
