<?php

namespace App\Filament\Docentes\Resources\CuartilInvestigacionDocentesResource\Pages;

use App\Filament\Docentes\Resources\CuartilInvestigacionDocentesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuartilInvestigacionDocentes extends ListRecords
{
    protected static string $resource = CuartilInvestigacionDocentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
