<?php

namespace App\Filament\Resources\TipoProductoInvestigacionResource\Pages;

use App\Filament\Resources\TipoProductoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoProductoInvestigacions extends ListRecords
{
    protected static string $resource = TipoProductoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
