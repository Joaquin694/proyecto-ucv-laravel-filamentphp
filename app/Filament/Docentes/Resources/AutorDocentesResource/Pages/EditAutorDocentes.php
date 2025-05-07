<?php

namespace App\Filament\Docentes\Resources\AutorDocentesResource\Pages;

use App\Filament\Docentes\Resources\AutorDocentesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutorDocentes extends EditRecord
{
    protected static string $resource = AutorDocentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
