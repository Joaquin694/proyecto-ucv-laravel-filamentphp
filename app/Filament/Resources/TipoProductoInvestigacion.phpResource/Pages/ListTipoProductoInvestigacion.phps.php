<?php

namespace App\Filament\Resources\TipoProductoInvestigacion.phpResource\Pages;

use App\Filament\Resources\TipoProductoInvestigacion.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoProductoInvestigacion.phps extends ListRecords
{
    protected static string $resource = TipoProductoInvestigacion.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
