<?php

namespace App\Filament\Resources\EstadoInvestigacionResource\Pages;

use App\Filament\Resources\EstadoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstadoInvestigacions extends ListRecords
{
    protected static string $resource = EstadoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
