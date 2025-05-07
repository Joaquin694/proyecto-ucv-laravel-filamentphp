<?php

namespace App\Filament\Resources\LineaInvestigacionEspecificaResource\Pages;

use App\Filament\Resources\LineaInvestigacionEspecificaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLineaInvestigacionEspecificas extends ListRecords
{
    protected static string $resource = LineaInvestigacionEspecificaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
