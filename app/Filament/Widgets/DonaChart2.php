<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Grado;
use App\Models\ProductoInvestigacion;
use App\Models\TipoProductoInvestigacion;

class DonaChart2 extends ChartWidget
{
    protected static ?string $heading = 'Distribución de Productos de Investigación';
    protected static ?string $maxHeight = '280px';
    protected static ?int $sort = 10;

    protected function getData(): array
    {
        $grados = ProductoInvestigacion::join('grados', 'producto_investigacion.id_grado', '=', 'grados.id_grado')
            ->whereIn('grados.tipo', ['Pregrado', 'Postgrado'])
            ->selectRaw('grados.tipo, COUNT(*) as total')
            ->groupBy('grados.tipo')
            ->pluck('total', 'grados.tipo')
            ->toArray();

        $productos = ProductoInvestigacion::selectRaw('id_tipo_producto, COUNT(*) as total')
            ->groupBy('id_tipo_producto')
            ->pluck('total', 'id_tipo_producto')
            ->toArray();

        $tipos = TipoProductoInvestigacion::pluck('nombre_tipo_producto', 'id_tipo_producto')->toArray();

        $data = [
            'Pregrado' => $grados['Pregrado'] ?? 0,
            'Postgrado' => $grados['Postgrado'] ?? 0,
        ];

        foreach ($productos as $id => $total) {
            if (isset($tipos[$id])) {
                $data[$tipos[$id]] = $total;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Distribución de Productos',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#4CAF50', '#2196F3', '#FF9800', '#FF5722', '#9C27B0', '#00BCD4', '#FFEB3B', '#607D8B',
                    ],
                    'borderColor' => '#fff',
                    'borderWidth' => 3,
                    'hoverBorderWidth' => 4,
                    'hoverBorderColor' => '#000',
                ],
            ],
            'labels' => array_keys($data),
            'options' => [
                'cutout' => '70%',
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'legend' => [
                        'position' => 'bottom',
                        'labels' => [
                            'font' => [
                                'family' => 'Arial, sans-serif',
                                'size' => 14,
                                'weight' => 'bold',
                                'lineHeight' => 1.2,
                            ],
                        ],
                    ],
                    'tooltip' => [
                        'enabled' => true,
                        'backgroundColor' => 'rgba(0,0,0,0.6)',
                        'titleFont' => [
                            'family' => 'Arial, sans-serif',
                            'size' => 14,
                            'weight' => 'bold',
                        ],
                    ],
                ],
                'animation' => [
                    'duration' => 1500,
                    'easing' => 'easeOutBounce',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
