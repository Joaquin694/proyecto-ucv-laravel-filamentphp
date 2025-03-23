<?php

namespace App\Filament\Resources\EstadoInvestigacion.phpResource\Pages;

use App\Filament\Resources\EstadoInvestigacion.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstadoInvestigacion.phps extends ListRecords
{
    protected static string $resource = EstadoInvestigacion.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
