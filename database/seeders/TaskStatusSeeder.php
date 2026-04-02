<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Backlog',
                'color_hex' => '#6B7280',
                'is_final_status' => false,
            ],
            [
                'name' => 'In Progress',
                'color_hex' => '#3B82F6',
                'is_final_status' => false,
            ],
            [
                'name' => 'Review',
                'color_hex' => '#F59E0B',
                'is_final_status' => false,
            ],
            [
                'name' => 'Done',
                'color_hex' => '#10B981',
                'is_final_status' => true,
            ],
        ];

        foreach ($statuses as $status) {
            TaskStatus::firstOrCreate(['name' => $status['name']], $status);
        }
    }
}
