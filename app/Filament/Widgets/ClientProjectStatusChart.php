<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ClientProjectStatusChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Chart';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Project Status',
                    'data' => [4, 2, 1],
                    'backgroundColor' => [
                        '#3b82f6', // Active (Blue)
                        '#22c55e', // Completed (Green)
                        '#ebb305', // On Hold (Yellow)
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => ['Active', 'Completed', 'On Hold'],
        ];
    }
}
