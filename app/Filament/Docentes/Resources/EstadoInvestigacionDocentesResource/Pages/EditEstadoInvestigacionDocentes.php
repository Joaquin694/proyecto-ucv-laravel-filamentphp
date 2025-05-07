<?php

namespace App\Filament\Docentes\Resources\EstadoInvestigacionDocentesResource\Pages;

use App\Filament\Docentes\Resources\EstadoInvestigacionDocentesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstadoInvestigacionDocentes extends EditRecord
{
    protected static string $resource = EstadoInvestigacionDocentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
