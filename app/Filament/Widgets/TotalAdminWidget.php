<?php

namespace App\Filament\Widgets;

use App\Models\ProductoInvestigacion;
use App\Models\EstadoInvestigacion;
use App\Models\Autor;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalAdminWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalAutores = Autor::count();
        $currentAutores = Autor::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->count();
        $lastAutores = Autor::whereMonth('created_at', now()->subMonth()->month)
                            ->whereYear('created_at', now()->subMonth()->year)
                            ->count();
        $autoresChange = $this->calculateChange($currentAutores, $lastAutores);

        $totalProductos = ProductoInvestigacion::count();
        $currentProductos = ProductoInvestigacion::whereMonth('created_at', now()->month)
                                                 ->whereYear('created_at', now()->year)
                                                 ->count();
        $lastProductos = ProductoInvestigacion::whereMonth('created_at', now()->subMonth()->month)
                                              ->whereYear('created_at', now()->subMonth()->year)
                                              ->count();
        $productosChange = $this->calculateChange($currentProductos, $lastProductos);

        $totalPublicacionesEnProceso = EstadoInvestigacion::where('nombre_estado', 'En proceso')->count();
        $currentPublicacionesEnProceso = EstadoInvestigacion::where('nombre_estado', 'En proceso')
                                                           ->whereMonth('created_at', now()->month)
                                                           ->whereYear('created_at', now()->year)
                                                           ->count();
        $lastPublicacionesEnProceso = EstadoInvestigacion::where('nombre_estado', 'En proceso')
                                                        ->whereMonth('created_at', now()->subMonth()->month)
                                                        ->whereYear('created_at', now()->subMonth()->year)
                                                        ->count();
        $publicacionesEnProcesoChange = $this->calculateChange($currentPublicacionesEnProceso, $lastPublicacionesEnProceso);

        $totalAceptadas = EstadoInvestigacion::where('nombre_estado', 'Aceptado')->count();
        $currentAceptadas = EstadoInvestigacion::where('nombre_estado', 'Aceptado')
                                               ->whereMonth('created_at', now()->month)
                                               ->whereYear('created_at', now()->year)
                                               ->count();
        $lastAceptadas = EstadoInvestigacion::where('nombre_estado', 'Aceptado')
                                            ->whereMonth('created_at', now()->subMonth()->month)
                                            ->whereYear('created_at', now()->subMonth()->year)
                                            ->count();
        $aceptadasChange = $this->calculateChange($currentAceptadas, $lastAceptadas);

        return [
            Stat::make('Total de Autores', $totalAutores)
                ->description($autoresChange['description'])
                ->descriptionIcon($autoresChange['icon'])
                ->color($autoresChange['color']),

            Stat::make('Producto Investigación', $totalProductos)
                ->description($productosChange['description'])
                ->descriptionIcon($productosChange['icon'])
                ->color($productosChange['color']),

            Stat::make('Publicaciones en Proceso', $totalPublicacionesEnProceso)
                ->description($publicacionesEnProcesoChange['description'])
                ->descriptionIcon($publicacionesEnProcesoChange['icon'])
                ->color($publicacionesEnProcesoChange['color']),

            Stat::make('Publicaciones Aceptadas', $totalAceptadas)
                ->description($aceptadasChange['description'])
                ->descriptionIcon($aceptadasChange['icon'])
                ->color($aceptadasChange['color']),
        ];
    }

    private function calculateChange(int $current, int $last): array
    {
        if ($last === 0 && $current > 0) {
            return [
                'description' => '+100% este mes',
                'icon' => 'heroicon-m-arrow-trending-up',
                'color' => 'success',
            ];
        } elseif ($last === 0 && $current === 0) {
            return [
                'description' => 'Sin cambio',
                'icon' => 'heroicon-m-minus',
                'color' => 'gray',
            ];
        }

        $change = (($current - $last) / $last) * 100;
        $rounded = round($change, 1);

        if ($change > 0) {
            return [
                'description' => "+$rounded% este mes",
                'icon' => 'heroicon-m-arrow-trending-up',
                'color' => 'success',
            ];
        } elseif ($change < 0) {
            return [
                'description' => "$rounded% este mes",
                'icon' => 'heroicon-m-arrow-trending-down',
                'color' => 'danger',
            ];
        } else {
            return [
                'description' => 'Sin cambio',
                'icon' => 'heroicon-m-minus',
                'color' => 'gray',
            ];
        }
    }
}
