<?php

namespace App\Services\Reports;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeLog;

class TimeEfficiencyReport
{
    public function generate(?int $projectId = null): array
    {
        $query = Project::with(['tasks.timeLogs']);

        if ($projectId) {
            $query->where('id', $projectId);
        }

        $projects = $query->get();
        $report = [];

        foreach ($projects as $project) {
            $totalLoggedMinutes = $project->tasks->flatMap->timeLogs->sum('duration');
            $totalLoggedHours = $totalLoggedMinutes / 60;

            // Estimate budgeted hours (can be enhanced with actual budget hours field)
            $budgetedHours = $project->budget ? ($project->budget / 100) : 0; // Rough estimate

            $efficiency = $budgetedHours > 0 ? ($totalLoggedHours / $budgetedHours) * 100 : 0;

            $report[] = [
                'project_id' => $project->id,
                'project_title' => $project->title,
                'logged_hours' => round($totalLoggedHours, 2),
                'budgeted_hours' => $budgetedHours,
                'efficiency_percentage' => round($efficiency, 2),
                'is_over_budget' => $totalLoggedHours > $budgetedHours,
            ];
        }

        return $report;
    }
}
