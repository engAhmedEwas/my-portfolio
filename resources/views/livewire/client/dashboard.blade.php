<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Projects Overview -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">My Projects</h3>
                    @forelse($projects as $project)
                        <div class="border-b dark:border-gray-700 last:border-0 pb-4 last:pb-0 mb-4 last:mb-0">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium">{{ $project->title }}</h4>
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $project->status }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Progress:
                                {{ $project->tasks->count() > 0 ? round(($project->tasks->where('status.is_final_status', true)->count() / $project->tasks->count()) * 100) : 0 }}%
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">No active projects.</p>
                    @endforelse
                </div>
            </div>

            <!-- Invoices Overview -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Invoices</h3>
                    @forelse($invoices as $invoice)
                        <div
                            class="flex justify-between items-center border-b dark:border-gray-700 last:border-0 pb-4 last:pb-0 mb-4 last:mb-0">
                            <div>
                                <p class="font-medium">Invoice #{{ substr($invoice->id, 0, 8) }}</p>
                                <p class="text-xs text-gray-500">Due:
                                    {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold">${{ number_format($invoice->total_amount, 2) }}</p>
                                <span
                                    class="text-xs px-2 py-0.5 rounded-full {{ $invoice->status === 'Paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $invoice->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No recent invoices.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>