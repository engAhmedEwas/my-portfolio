<?php

namespace App\Services\Reports;

use App\Models\Invoice;
use App\Models\Expense;

class ProfitMarginReport
{
    public function generate(): array
    {
        $totalRevenue = Invoice::where('status', 'Paid')->sum('total_amount');
        $totalExpenses = Expense::sum('amount');
        $profit = $totalRevenue - $totalExpenses;
        $profitMargin = $totalRevenue > 0 ? ($profit / $totalRevenue) * 100 : 0;

        return [
            'total_revenue' => $totalRevenue,
            'total_expenses' => $totalExpenses,
            'profit' => $profit,
            'profit_margin_percentage' => round($profitMargin, 2),
        ];
    }
}
