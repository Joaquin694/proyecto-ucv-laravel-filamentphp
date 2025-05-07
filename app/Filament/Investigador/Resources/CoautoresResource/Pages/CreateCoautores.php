<?php

namespace App\Filament\Investigador\Resources\CoautoresResource\Pages;

use App\Filament\Investigador\Resources\CoautoresResource;
use App\Models\AutorProducto;
use Filament\Resources\Pages\CreateRecord;

class CreateCoautores extends CreateRecord
{
    protected static string $resource = CoautoresResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Aquí creas el registro y lo devuelves
        return AutorProducto::create($data);
    }
}
