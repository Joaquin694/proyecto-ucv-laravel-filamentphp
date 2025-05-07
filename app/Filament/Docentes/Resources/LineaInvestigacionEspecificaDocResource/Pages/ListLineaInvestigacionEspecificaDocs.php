<?php

namespace App\Filament\Docentes\Resources\LineaInvestigacionEspecificaDocResource\Pages;

use App\Filament\Docentes\Resources\LineaInvestigacionEspecificaDocResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLineaInvestigacionEspecificaDocs extends ListRecords
{
    protected static string $resource = LineaInvestigacionEspecificaDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
