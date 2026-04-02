<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\Expense;
use Carbon\Carbon;

class CancelProjectAction
{
    /**
     * Cancel a project with appropriate financial logic.
     *
     * @param Project $project
     * @param string $cancelledBy 'client' or 'admin'
     * @return Project
     */
    public function execute(Project $project, string $cancelledBy): Project
    {
        $forfeitAmount = 0;

        if ($cancelledBy === 'client') {
            // Client cancellation: 25% forfeit
            $forfeitAmount = $project->budget * 0.25;
        } elseif ($cancelledBy === 'admin') {
            // Admin cancellation: Full refund (0% forfeit)
            $forfeitAmount = 0;
        }

        // Update project
        $project->update([
            'status' => 'Cancelled',
            'cancelled_by' => $cancelledBy,
            'cancellation_date' => Carbon::now(),
            'forfeit_amount' => $forfeitAmount,
        ]);

        // Record expense if there's a forfeit
        if ($forfeitAmount > 0) {
            Expense::create([
                'amount' => $forfeitAmount,
                'category' => 'Project Cancellation Forfeit',
                'date' => Carbon::now(),
            ]);
        }

        return $project->fresh();
    }
}
