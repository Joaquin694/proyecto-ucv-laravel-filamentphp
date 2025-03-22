<?php

namespace App\Filament\Resources\ProductoInvestigacionResource\Pages;

use App\Filament\Resources\ProductoInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductoInvestigacions extends ListRecords
{
    protected static string $resource = ProductoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
