<?php

namespace App\Filament\Investigador\Widgets;

use App\Models\Autor;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class TotalInvestigadorWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $autor = Autor::find(Auth::id());

        if (!$autor) {
            return [];
        }

        $productosQuery = $autor->productos();

        $mesActual = now();
        $mesAnterior = now()->subMonth();

        $enProcesoEsteMes = (clone $productosQuery)
            ->whereMonth('producto_investigacion.created_at', $mesActual->month)
            ->whereYear('producto_investigacion.created_at', $mesActual->year)
            ->whereHas('estado', function ($q) {
                $q->where('nombre_estado', '!=', 'Aceptado');
            })
            ->count();

        $enProcesoMesPasado = (clone $productosQuery)
            ->whereMonth('producto_investigacion.created_at', $mesAnterior->month)
            ->whereYear('producto_investigacion.created_at', $mesAnterior->year)
            ->whereHas('estado', function ($q) {
                $q->where('nombre_estado', '!=', 'Aceptado');
            })
            ->count();

        $cambioEnProceso = $this->calcularCambio($enProcesoEsteMes, $enProcesoMesPasado);

        $aceptadosEsteMes = (clone $productosQuery)
            ->whereMonth('producto_investigacion.created_at', $mesActual->month)
            ->whereYear('producto_investigacion.created_at', $mesActual->year)
            ->whereHas('estado', function ($q) {
                $q->where('nombre_estado', 'Aceptado');
            })
            ->count();

        $aceptadosMesPasado = (clone $productosQuery)
            ->whereMonth('producto_investigacion.created_at', $mesAnterior->month)
            ->whereYear('producto_investigacion.created_at', $mesAnterior->year)
            ->whereHas('estado', function ($q) {
                $q->where('nombre_estado', 'Aceptado');
            })
            ->count();

        $cambioAceptados = $this->calcularCambio($aceptadosEsteMes, $aceptadosMesPasado);

        $totalProductos = (clone $productosQuery)->count();

        return [
            Stat::make('Productos en Proceso', $enProcesoEsteMes)
                ->description($cambioEnProceso['description'])
                ->color($cambioEnProceso['color']),

            Stat::make('Productos Aceptados', $aceptadosEsteMes)
                ->description($cambioAceptados['description'])
                ->color($cambioAceptados['color']),

            Stat::make('Total Productos', $totalProductos)
                ->description('Total de productos gestionados')
                ->color('primary'),
        ];
    }

    private function calcularCambio($actual, $anterior): array
    {
        if ($anterior > 0) {
            $porcentaje = (($actual - $anterior) / $anterior) * 100;
        } elseif ($actual > 0) {
            $porcentaje = 100;
        } else {
            $porcentaje = 0;
        }

        if ($porcentaje > 0) {
            return [
                'description' => '+' . round($porcentaje, 1) . '% este mes',
                'color' => 'success',
            ];
        } elseif ($porcentaje < 0) {
            return [
                'description' => round($porcentaje, 1) . '% este mes',
                'color' => 'danger',
            ];
        }

        return [
            'description' => 'Sin cambio',
            'color' => 'gray',
        ];
    }
}
