<?php

namespace App\Filament\Resources\CuartilInvestigacionResource\Pages;

use App\Filament\Resources\CuartilInvestigacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCuartilInvestigacion extends EditRecord
{
    protected static string $resource = CuartilInvestigacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
