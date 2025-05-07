<?php

namespace App\Filament\Docentes\Resources\LineaInvestigacionGeneralDocResource\Pages;

use App\Filament\Docentes\Resources\LineaInvestigacionGeneralDocResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLineaInvestigacionGeneralDoc extends EditRecord
{
    protected static string $resource = LineaInvestigacionGeneralDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
