<?php

namespace App\Filament\Docentes\Resources\AutorDocenteResource\Pages;

use App\Filament\Docentes\Resources\AutorDocenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutorDocente extends EditRecord
{
    protected static string $resource = AutorDocenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
