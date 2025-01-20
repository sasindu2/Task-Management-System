@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Create New Task</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                @include('tasks.form')
                
                <button type="submit" class="btn btn-primary">Create Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection