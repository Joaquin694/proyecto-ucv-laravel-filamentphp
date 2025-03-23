<?php

namespace App\Filament\Resources\LineaInvestigacionEspecifica.phpResource\Pages;

use App\Filament\Resources\LineaInvestigacionEspecifica.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLineaInvestigacionEspecifica.php extends EditRecord
{
    protected static string $resource = LineaInvestigacionEspecifica.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
