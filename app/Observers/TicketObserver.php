<?php

namespace App\Observers;

use App\Models\SupportTicket;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Support\Facades\Notification;

class TicketObserver
{
    public function created(SupportTicket $ticket): void
    {
        // Notify all admins about the new ticket
        $admins = User::whereHas('role', function ($query) {
            $query->whereIn('name', ['Super Admin', 'Admin']);
        })->get();

        Notification::send($admins, new NewTicketNotification($ticket));
    }
}
