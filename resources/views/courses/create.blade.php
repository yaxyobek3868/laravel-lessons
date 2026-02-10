@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <h2 class="card-header alert alert-info h4 text-center">
        {{ __('messages.add_course') }}
    </h2>

    <form action="{{ route('courses.store') }}" class="card-body" method="POST">
        @csrf

        <div class="mb-3 col-md-4">
            <label class="form-label">
                {{ __('messages.title') }}
            </label>
            <input type="text"
                   name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}">

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
                      rows="4">{{ old('description') }}</textarea>

            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-success">
            {{ __('messages.save') }}
        </button>

        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
            {{ __('messages.back') }}
        </a>
    </form>
</div>
@endsection
