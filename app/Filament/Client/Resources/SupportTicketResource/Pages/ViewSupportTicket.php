<?php

namespace App\Filament\Client\Resources\SupportTicketResource\Pages;

use App\Filament\Client\Resources\SupportTicketResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSupportTicket extends ViewRecord
{
    protected static string $resource = SupportTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
