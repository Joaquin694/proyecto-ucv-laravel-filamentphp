<?php

namespace App\Filament\Investigador\Resources\PatenteResource\Pages;

use App\Filament\Investigador\Resources\PatenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatente extends EditRecord
{
    protected static string $resource = PatenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
