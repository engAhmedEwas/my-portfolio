<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Project;
use App\Models\Role;
use App\Models\SupportTicket;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_ticket_sends_notification_to_admins()
    {
        Notification::fake();

        $this->seed();

        $adminRole = Role::where('name', 'Admin')->first();
        $admin = User::factory()->create(['role_id' => $adminRole->id]);

        $clientRole = Role::where('name', 'Client')->first();
        $clientUser = User::factory()->create(['role_id' => $clientRole->id]);
        $client = Client::create(['user_id' => $clientUser->id, 'company_name' => 'Test Co']);

        $ticket = SupportTicket::create([
            'client_id' => $client->id,
            'subject' => 'Test Ticket',
            'description' => 'Test description',
            'priority' => 'High',
        ]);

        Notification::assertSentTo(
            [$admin],
            NewTicketNotification::class,
            function ($notification, $channels) use ($ticket) {
                return $notification->ticket->id === $ticket->id;
            }
        );
    }
}
