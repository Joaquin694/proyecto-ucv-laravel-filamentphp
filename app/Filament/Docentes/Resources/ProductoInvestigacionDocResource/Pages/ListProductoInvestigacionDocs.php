<?php

namespace App\Filament\Docentes\Resources\ProductoInvestigacionDocResource\Pages;

use App\Filament\Docentes\Resources\ProductoInvestigacionDocResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductoInvestigacionDocs extends ListRecords
{
    protected static string $resource = ProductoInvestigacionDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
