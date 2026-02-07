@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Lessons List</h2>
            <a href="{{ route('lessons.create') }}" class="btn btn-primary">
                Create Lesson
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Group</th>
                <th>Title</th>
                <th>File</th>
                <th>Created At</th>
                <th width="180">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->id }}</td>
                    <td>{{ $lesson->group->name ?? '-' }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>
                        @if($lesson->file)
                            <a href="{{ asset('storage/'.$lesson->file) }}" target="_blank">
                                View File
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $lesson->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete lesson?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No lessons found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
