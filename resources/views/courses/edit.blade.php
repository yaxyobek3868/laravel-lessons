@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <h2 class="card-header alert alert-info h4 text-center">
        {{ __('messages.edit_course') }}
    </h2>

    <form action="{{ route('courses.update', $course) }}" class="card-body" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3 col-md-4">
            <label class="form-label">
                {{ __('messages.title') }}
            </label>
            <input type="text"
                   name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $course->title) }}">

            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3 col-md-4">
            <label class="form-label">
                {{ __('messages.description') }}
            </label>
            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror"
                      rows="4">{{ old('description', $course->description) }}</textarea>

            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">
            {{ __('messages.update') }}
        </button>

        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
            {{ __('messages.back') }}
        </a>
    </form>
</div>
@endsection
