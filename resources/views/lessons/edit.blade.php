@extends('layouts.app')

@section('content')

<div class="card mt-5">
    <h2 class="card-header alert alert-info h4 text-center">{{ __('messages.edit_lesson') }}</h2>

    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST" class="card-body" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
  
            <div class="mb-3 col-md-6">
                <label>{{ __('messages.group') }}</label>
                <select name="group_id" class="form-control @error('group_id') is-invalid @enderror" required>
                    <option value="">{{ __('messages.select_group') }}</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" 
                            {{ old('group_id', $lesson->group_id) == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
                @error('group_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label>{{ __('messages.title') }}</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                       value="{{ old('title', $lesson->title) }}" required>
                @error('title')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-12">
                <label>{{ __('messages.content') }}</label>
                <textarea name="content" rows="5" 
                          class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $lesson->content) }}</textarea>
                @error('content')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label>{{ __('messages.file') }} </label>
                
                @if($lesson->file)
                    <div class="mb-2">
                        <small class="text-muted"></small>
                        <a href="{{ Storage::url($lesson->file) }}" target="_blank" class="d-block">
                            {{ basename($lesson->file) }}
                        </a>
                    </div>
                @endif
                
                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                <small class="text-muted"></small>
                @error('file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <button class="btn btn-success">{{ __('messages.update') }}</button>
        <a href="{{ route('lessons.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>

@endsection