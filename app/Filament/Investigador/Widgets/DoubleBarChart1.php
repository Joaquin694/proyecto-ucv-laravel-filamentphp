<?php

namespace App\Filament\Investigador\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use App\Models\Grado;
use App\Models\ProductoInvestigacion;
use Illuminate\Support\Facades\Auth;

class DoubleBarChart1 extends ChartWidget
{
    protected static ?string $heading = 'Productos de Investigación';
    protected static ?string $maxHeight = '400px';

    protected function getData(): array
    {
    $autor = Auth::guard('investigador')->user();

    $fechaInicio = Carbon::now()->subMonths(5)->startOfMonth()->toDateString();
    $fechaFin = Carbon::now()->endOfMonth()->toDateString();

    $meses = collect([]);
    for ($i = 5; $i >= 0; $i--) {
        $meses->push(Carbon::now()->subMonths($i)->format('Y-m'));
    }

    $resultados = ProductoInvestigacion::whereHas('autores', function ($query) use ($autor) {
        $query->where('autor_producto.id_autor', $autor->id_autor);
    })
    ->whereBetween('fecha_publicacion', [$fechaInicio, $fechaFin])
    ->selectRaw("strftime('%Y-%m', fecha_publicacion) as mes, id_grado, COUNT(*) as total")
    ->groupBy('mes', 'id_grado')
    ->get();

    $pregradoIDs = Grado::where('tipo', 'Pregrado')->pluck('id_grado')->toArray();
    $postgradoIDs = Grado::where('tipo', 'Postgrado')->pluck('id_grado')->toArray();

    $pregrado = [];
    $postgrado = [];

    foreach ($meses as $mes) {
        $pregrado[] = $resultados->where('mes', $mes)->whereIn('id_grado', $pregradoIDs)->sum('total');
        $postgrado[] = $resultados->where('mes', $mes)->whereIn('id_grado', $postgradoIDs)->sum('total');
    }
         return [
             'labels' => $meses->toArray(),
             'datasets' => [
                 [
                     'label' => 'Pregrado',
                     'data' => $pregrado,
                     'backgroundColor' => 'rgba(65, 105, 225, 0.6)',
                     'borderColor' => 'rgba(65, 105, 225, 1)',
                     'borderWidth' => 2,
                     'hoverBorderWidth' => 3,
                     'hoverBorderColor' => '#000',
                 ],
                 [
                     'label' => 'Postgrado',
                     'data' => $postgrado,
                     'backgroundColor' => 'rgba(255, 99, 71, 0.6)',
                     'borderColor' => 'rgba(255, 99, 71, 1)',
                     'borderWidth' => 2,
                     'hoverBorderWidth' => 3,
                     'hoverBorderColor' => '#000',
                 ],
             ],
             'options' => [
                 'scales' => [
                     'y' => [
                         'beginAtZero' => true,
                         'ticks' => [
                             'font' => [
                                 'family' => 'Arial, sans-serif',
                                 'size' => 14,
                                 'weight' => 'bold',
                             ],
                         ],
                     ],
                 ],
                 'plugins' => [
                     'tooltip' => [
                         'backgroundColor' => 'rgba(0,0,0,0.7)',
                         'titleFont' => [
                             'family' => 'Arial, sans-serif',
                             'size' => 14,
                             'weight' => 'bold',
                         ],
                         'bodyFont' => [
                             'family' => 'Arial, sans-serif',
                             'size' => 12,
                         ],
                         'callbacks' => [
                             'label' => 'function(tooltipItem) { return tooltipItem.raw; }',
                         ],
                     ],
                     'legend' => [
                         'labels' => [
                             'font' => [
                                 'family' => 'Arial, sans-serif',
                                 'size' => 14,
                                 'weight' => 'bold',
                             ],
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
         return 'bar';
     }
 }
