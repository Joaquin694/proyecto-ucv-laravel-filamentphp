<?php

namespace App\Filament\Investigador\Resources\ArticulosResource\Pages;

use App\Filament\Investigador\Resources\ArticulosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticulos extends EditRecord
{
    protected static string $resource = ArticulosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
