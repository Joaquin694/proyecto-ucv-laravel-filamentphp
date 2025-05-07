<?php

namespace App\Filament\Docentes\Resources\GradoDoResource\Pages;

use App\Filament\Docentes\Resources\GradoDoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGradoDos extends ListRecords
{
    protected static string $resource = GradoDoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
