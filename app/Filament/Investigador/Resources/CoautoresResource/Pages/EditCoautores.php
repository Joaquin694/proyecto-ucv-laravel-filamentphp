<?php

namespace App\Filament\Investigador\Resources\CoautoresResource\Pages;

use App\Filament\Investigador\Resources\CoautoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoautores extends EditRecord
{
    protected static string $resource = CoautoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
