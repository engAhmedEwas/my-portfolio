<?php

namespace App\Livewire\Admin;

use App\Models\Task;
use App\Models\TaskStatus;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class KanbanBoard extends Component
{
    public $projectId = null;

    #[Layout('layouts.app')]
    public function render()
    {
        $statuses = TaskStatus::all();
        $tasks = Task::with(['status', 'assignedTo'])
            ->when($this->projectId, fn($q) => $q->where('project_id', $this->projectId))
            ->get()
            ->groupBy('status_id');

        return view('livewire.admin.kanban-board', [
            'statuses' => $statuses,
            'tasks' => $tasks,
        ]);
    }

    #[On('task-moved')]
    public function updateTaskStatus($taskId, $newStatusId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->update(['status_id' => $newStatusId]);
            $this->dispatch('task-updated');
        }
    }
}
