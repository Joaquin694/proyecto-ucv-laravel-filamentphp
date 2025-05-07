<?php

namespace App\Filament\Docentes\Resources\EstadoInvestigacionDocentesResource\Pages;

use App\Filament\Docentes\Resources\EstadoInvestigacionDocentesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstadoInvestigacionDocentes extends ListRecords
{
    protected static string $resource = EstadoInvestigacionDocentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
