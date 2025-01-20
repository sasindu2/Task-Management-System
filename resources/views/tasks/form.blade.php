<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" 
           id="title" name="title" value="{{ old('title', $task->title ?? '') }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" name="description" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($task))
    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_completed" 
                   name="is_completed" value="1" {{ $task->is_completed ? 'checked' : '' }}>
            <label class="form-check-label" for="is_completed">Mark as completed</label>
        </div>
    </div>
@endif