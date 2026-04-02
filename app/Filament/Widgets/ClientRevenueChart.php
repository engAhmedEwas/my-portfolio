<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ClientRevenueChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)', // Blue-500 with opacity
                    'borderColor' => '#3b82f6',
                    'fill' => true,
                    'tension' => 0.4, // Smooth curve
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
