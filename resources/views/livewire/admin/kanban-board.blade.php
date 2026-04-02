<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Kanban Board</h2>

                <div class="flex gap-4 overflow-x-auto pb-4">
                    @foreach($statuses as $status)
                        <div class="flex-shrink-0 w-80">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <div class="flex items-center mb-4">
                                    <div class="w-3 h-3 rounded-full mr-2"
                                        style="background-color: {{ $status->color_hex }}"></div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $status->name }}
                                    </h3>
                                    <span class="ml-auto text-sm text-gray-500">
                                        {{ $tasks->get($status->id)?->count() ?? 0 }}
                                    </span>
                                </div>

                                <div class="space-y-3" x-data="{ statusId: '{{ $status->id }}' }" @drop.prevent="
                                             const taskId = $event.dataTransfer.getData('taskId');
                                             $wire.dispatch('task-moved', { taskId: taskId, newStatusId: statusId });
                                         " @dragover.prevent>

                                    @foreach($tasks->get($status->id) ?? [] as $task)
                                        <div class="bg-white dark:bg-gray-800 p-3 rounded shadow-sm border dark:border-gray-600 cursor-move"
                                            draggable="true"
                                            @dragstart="$event.dataTransfer.setData('taskId', '{{ $task->id }}')">
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-1">
                                                {{ $task->title }}
                                            </h4>
                                            @if($task->assignedTo)
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    Assigned to: {{ $task->assignedTo->name }}
                                                </p>
                                            @endif
                                            @if($task->due_date)
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    Due: {{ $task->due_date->format('M d, Y') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>