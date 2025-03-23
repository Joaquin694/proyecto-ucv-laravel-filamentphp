<?php

namespace App\Filament\Resources\LineaInvestigacionGeneral.phpResource\Pages;

use App\Filament\Resources\LineaInvestigacionGeneral.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLineaInvestigacionGeneral.phps extends ListRecords
{
    protected static string $resource = LineaInvestigacionGeneral.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
