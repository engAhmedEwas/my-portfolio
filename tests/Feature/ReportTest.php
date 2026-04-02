<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Services\Reports\ClientHealthReport;
use App\Services\Reports\ProfitMarginReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_profit_margin_report_calculates_correctly()
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
            'status' => 'Paid',
            'issue_date' => now(),
        ]);

        InvoicePayment::create([
            'invoice_id' => $invoice->id,
            'amount' => 5000,
        ]);

        Expense::create([
            'amount' => 2000,
            'category' => 'Operating Costs',
            'date' => now(),
        ]);

        $report = (new ProfitMarginReport())->generate();

        $this->assertEquals(5000, $report['total_revenue']);
        $this->assertEquals(2000, $report['total_expenses']);
        $this->assertEquals(3000, $report['profit']);
        $this->assertEquals(60, $report['profit_margin_percentage']);
    }

    public function test_client_health_report_identifies_at_risk_clients()
    {
        $this->seed();

        $user = User::factory()->create(['role_id' => Role::where('name', 'Client')->first()->id]);
        $client = Client::create(['user_id' => $user->id, 'company_name' => 'Test Co']);
        $project = Project::create([
            'client_id' => $client->id,
            'title' => 'Test Project',
            'budget' => 10000,
        ]);

        // Create overdue invoice
        Invoice::create([
            'project_id' => $project->id,
            'total_amount' => 5000,
            'status' => 'Sent',
            'issue_date' => now()->subDays(40),
            'due_date' => now()->subDays(10),
        ]);

        $report = (new ClientHealthReport())->generate();

        $this->assertCount(1, $report);
        $this->assertEquals('Test Co', $report[0]['company_name']);
        $this->assertEquals(5000, $report[0]['outstanding_balance']);
        $this->assertEquals(1, $report[0]['overdue_invoices']);
        $this->assertLessThan(70, $report[0]['health_score']);
    }
}
