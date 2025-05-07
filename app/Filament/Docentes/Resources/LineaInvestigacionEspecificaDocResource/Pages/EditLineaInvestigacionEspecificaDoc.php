<?php

namespace App\Filament\Docentes\Resources\LineaInvestigacionEspecificaDocResource\Pages;

use App\Filament\Docentes\Resources\LineaInvestigacionEspecificaDocResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLineaInvestigacionEspecificaDoc extends EditRecord
{
    protected static string $resource = LineaInvestigacionEspecificaDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
