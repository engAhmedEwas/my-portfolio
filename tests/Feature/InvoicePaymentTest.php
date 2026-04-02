<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoicePaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_calculates_amount_paid()
    {
        $this->seed();

        $user = User::factory()->create(['role_id' => Role::where('name', 'Client')->first()->id]);
        $client = Client::create(['user_id' => $user->id, 'company_name' => 'Test Co']);
        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'Test Project',
            'budget' => 10000,
        ]);

        $invoice = Invoice::create([
            'project_id' => $project->id,
            'total_amount' => 5000,
            'status' => 'Sent',
            'issue_date' => now(),
        ]);

        InvoicePayment::create([
            'invoice_id' => $invoice->id,
            'amount' => 1250,
            'payment_method' => 'Bank Transfer',
        ]);

        InvoicePayment::create([
            'invoice_id' => $invoice->id,
            'amount' => 750,
            'payment_method' => 'Credit Card',
        ]);

        $this->assertEquals(2000, $invoice->fresh()->amount_paid);
        $this->assertEquals(3000, $invoice->fresh()->amount_due);
        $this->assertFalse($invoice->fresh()->is_fully_paid);
    }

    public function test_invoice_is_fully_paid()
    {
        $this->seed();

        $user = User::factory()->create(['role_id' => Role::where('name', 'Client')->first()->id]);
        $client = Client::create(['user_id' => $user->id, 'company_name' => 'Test Co']);
        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'Test Project',
            'budget' => 10000,
        ]);

        $invoice = Invoice::create([
            'project_id' => $project->id,
            'total_amount' => 5000,
            'status' => 'Sent',
            'issue_date' => now(),
        ]);

        InvoicePayment::create([
            'invoice_id' => $invoice->id,
            'amount' => 5000,
            'payment_method' => 'Bank Transfer',
        ]);

        $this->assertEquals(5000, $invoice->fresh()->amount_paid);
        $this->assertEquals(0, $invoice->fresh()->amount_due);
        $this->assertTrue($invoice->fresh()->is_fully_paid);
    }
}
