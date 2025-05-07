<?php

namespace App\Filament\Investigador\Resources\ProductoInvestigacionResource\Pages;

use App\Filament\Investigador\Resources\ProductoInvestigacionResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;

class Settings extends Page
{
    protected static string $resource = ProductoInvestigacionResource::class;

    protected static string $view = 'filament.investigador.resources.producto-investigacion-resource.pages.settings';


}
