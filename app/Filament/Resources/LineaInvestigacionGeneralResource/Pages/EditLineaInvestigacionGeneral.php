<?php

namespace App\Filament\Resources\LineaInvestigacionGeneralResource\Pages;

use App\Filament\Resources\LineaInvestigacionGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLineaInvestigacionGeneral extends EditRecord
{
    protected static string $resource = LineaInvestigacionGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
