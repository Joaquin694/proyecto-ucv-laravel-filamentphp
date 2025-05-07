<?php

namespace App\Filament\Docentes\Resources\CuartilInvestigacionDocentesResource\Pages;

use App\Filament\Docentes\Resources\CuartilInvestigacionDocentesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCuartilInvestigacionDocentes extends EditRecord
{
    protected static string $resource = CuartilInvestigacionDocentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
