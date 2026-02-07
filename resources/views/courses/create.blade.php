@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Create Course</h2>

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Group ID</label>
                <input type="number" name="group_id" class="form-control" value="{{ old('group_id') }}">
                @error('group_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success">Save</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
