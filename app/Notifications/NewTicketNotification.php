<?php

namespace App\Notifications;

use App\Models\SupportTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTicketNotification extends Notification
{
    use Queueable;

    public function __construct(public SupportTicket $ticket)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Support Ticket: ' . $this->ticket->subject)
            ->line('A new support ticket has been created.')
            ->line('Subject: ' . $this->ticket->subject)
            ->line('Priority: ' . $this->ticket->priority)
            ->line('Client: ' . $this->ticket->client->company_name)
            ->action('View Ticket', url('/admin/tickets/' . $this->ticket->id))
            ->line('Thank you for your attention!');
    }

    public function toArray($notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'subject' => $this->ticket->subject,
            'priority' => $this->ticket->priority,
            'client_name' => $this->ticket->client->company_name,
        ];
    }
}
