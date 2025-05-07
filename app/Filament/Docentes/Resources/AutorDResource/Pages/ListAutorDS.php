<?php

namespace App\Filament\Docentes\Resources\AutorDResource\Pages;

use App\Filament\Docentes\Resources\AutorDResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAutorDS extends ListRecords
{
    protected static string $resource = AutorDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
