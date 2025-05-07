<?php

namespace App\Filament\Resources\LineaInvestigacionGeneralResource\Pages;

use App\Filament\Resources\LineaInvestigacionGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLineaInvestigacionGenerals extends ListRecords
{
    protected static string $resource = LineaInvestigacionGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
