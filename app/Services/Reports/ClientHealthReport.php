<?php

namespace App\Services\Reports;

use App\Models\Client;
use App\Models\Invoice;

class ClientHealthReport
{
    public function generate(): array
    {
        $clients = Client::with(['projects.invoices.payments'])->get();
        $report = [];

        foreach ($clients as $client) {
            $totalBilled = $client->projects->flatMap->invoices->sum('total_amount');
            $totalPaid = $client->projects->flatMap->invoices->flatMap->payments->sum('amount');
            $outstandingBalance = $totalBilled - $totalPaid;

            $overdueInvoices = $client->projects->flatMap->invoices
                ->where('status', '!=', 'Paid')
                ->filter(fn($invoice) => $invoice->due_date && $invoice->due_date->isPast())
                ->count();

            $healthScore = 100;
            if ($outstandingBalance > 0) {
                $healthScore -= 30;
            }
            if ($overdueInvoices > 0) {
                $healthScore -= ($overdueInvoices * 10);
            }
            $healthScore = max(0, $healthScore);

            $report[] = [
                'client_id' => $client->id,
                'company_name' => $client->company_name,
                'total_billed' => $totalBilled,
                'total_paid' => $totalPaid,
                'outstanding_balance' => $outstandingBalance,
                'overdue_invoices' => $overdueInvoices,
                'health_score' => $healthScore,
                'status' => $healthScore >= 70 ? 'Healthy' : ($healthScore >= 40 ? 'At Risk' : 'Critical'),
            ];
        }

        return $report;
    }
}
