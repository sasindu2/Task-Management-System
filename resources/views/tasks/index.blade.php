@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('tasks.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search tasks..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
        <div class="col-md-6">
            <div class="btn-group float-end">
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">All</a>
                <a href="{{ route('tasks.index', ['status' => 'pending']) }}" class="btn btn-outline-secondary">Pending</a>
                <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="btn btn-outline-secondary">Completed</a>
            </div>
        </div>
    </div>

    <div class="list-group">
        @forelse($tasks as $task)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" class="form-check-input me-2" 
                               onChange="this.form.submit()"
                               {{ $task->is_completed ? 'checked' : '' }}>
                    </form>
                    <div>
                        <h5 class="mb-1 {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                            {{ $task->title }}
                        </h5>
                        <p class="mb-1">{{ $task->description }}</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center">No tasks found.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
@endsection 