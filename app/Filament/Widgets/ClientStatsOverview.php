<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClientStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Revenue', '$192.4k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('New Projects', '12')
                ->description('4 in progress')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary'),
            Stat::make('Pending Invoices', '$4,250')
                ->description('Due within 7 days')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
