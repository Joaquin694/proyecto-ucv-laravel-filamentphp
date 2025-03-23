<?php

namespace App\Filament\Resources\CuartilInvestigacion.phpResource\Pages;

use App\Filament\Resources\CuartilInvestigacion.phpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCuartilInvestigacion.php extends EditRecord
{
    protected static string $resource = CuartilInvestigacion.phpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
