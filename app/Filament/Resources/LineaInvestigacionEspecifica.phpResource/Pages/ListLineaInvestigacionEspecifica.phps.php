<?php

namespace App\Filament\Resources\LineaInvestigacionEspecifica.phpResource\Pages;

use App\Filament\Resources\LineaInvestigacionEspecifica.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLineaInvestigacionEspecifica.phps extends ListRecords
{
    protected static string $resource = LineaInvestigacionEspecifica.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
