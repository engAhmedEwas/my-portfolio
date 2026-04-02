<?php

namespace App\Filament\Client\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';



    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\ClientStatsOverview::class,
            \App\Filament\Widgets\ClientRevenueChart::class,
            \App\Filament\Widgets\ClientProjectStatusChart::class,
            \App\Filament\Widgets\ClientLatestProjects::class,
        ];
    }

    public function getColumns(): int|string|array
    {
        return 2;
    }
}