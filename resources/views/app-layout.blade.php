<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Search and Filter -->
                    <div class="mb-4 flex justify-between">
                        <form action="{{ route('tasks.index') }}" method="GET" class="flex gap-4">
                            <input type="text" name="search" placeholder="Search tasks..." 
                                class="rounded-md border-gray-300" value="{{ request('search') }}">
                            
                            <select name="status" class="rounded-md border-gray-300">
                                <option value="">All Tasks</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
                        </form>
                        
                        <a href="{{ route('tasks.create') }}" 
                            class="bg-green-500 text-white px-4 py-2 rounded-md">
                            Add New Task
                        </a>
                    </div>

                    <!-- Tasks List -->
                    <div class="mt-6">
                        @foreach($tasks as $task)
                            <div class="flex items-center justify-between p-4 border-b {{ $task->is_completed ? 'bg-gray-50' : '' }}">
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="checkbox" 
                                            onChange="this.form.submit()"
                                            {{ $task->is_completed ? 'checked' : '' }}
                                            class="rounded">
                                    </form>
                                    
                                    <div>
                                        <h3 class="font-semibold {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                                            {{ $task->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $task->description }}</p>
                                        @if($task->due_date)
                                            <p class="text-xs text-gray-500">Due: {{ $task->due_date->format('Y-m-d') }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('tasks.edit', $task) }}" 
                                        class="bg-blue-500 text-white px-3 py-1 rounded-md">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" 
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded-md">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="mt-4">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>