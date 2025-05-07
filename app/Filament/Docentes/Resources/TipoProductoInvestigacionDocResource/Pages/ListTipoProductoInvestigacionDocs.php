<?php

namespace App\Filament\Docentes\Resources\TipoProductoInvestigacionDocResource\Pages;

use App\Filament\Docentes\Resources\TipoProductoInvestigacionDocResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoProductoInvestigacionDocs extends ListRecords
{
    protected static string $resource = TipoProductoInvestigacionDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
