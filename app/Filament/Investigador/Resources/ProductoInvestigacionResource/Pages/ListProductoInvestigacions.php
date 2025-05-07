<?php

namespace App\Filament\Investigador\Resources\ProductoInvestigacionResource\Pages;

use App\Filament\Investigador\Resources\ProductoInvestigacionResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductoInvestigacions extends ListRecords
{
    protected static string $resource = ProductoInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
