<?php
namespace App\Filament\Investigador\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DonaChart extends ChartWidget
{
    protected static ?string $heading = 'Avances del estado del Producto de Investigación';
    protected static ?string $maxHeight = '210px';

    protected function getData(): array
    {
        $autor = Auth::guard('investigador')->user();

        if (!$autor) {
            dd('No hay autor autenticado');
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $idAutor = $autor->id_autor;

        $result = DB::table('producto_investigacion')
            ->join('estado_investigacion', 'producto_investigacion.id_estado', '=', 'estado_investigacion.id_estado')
            ->join('autor_producto', 'producto_investigacion.id_producto', '=', 'autor_producto.id_producto')
            ->where('autor_producto.id_autor', $idAutor)
            ->groupBy('estado_investigacion.nombre_estado')
            ->select('estado_investigacion.nombre_estado', DB::raw('COUNT(DISTINCT producto_investigacion.id_producto) as total'))
            ->get();

        $labels = [];
        $data = [];
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
        ];

        foreach ($result as $index => $row) {
            $labels[] = $row->nombre_estado;
            $data[] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Productos por estado',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => '#fff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
            'options' => [
                'cutout' => '70%',
                'plugins' => [
                    'legend' => [
                        'position' => 'right',
                    ],
                ],
            ],
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
}
