@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Courses List</h2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                Create Course
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Group ID</th>
                <th>Created At</th>
                <th width="180">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description}}</td>
                    <td>{{ $course->group_id }}</td>
                    <td>{{ $course->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">
                            View
                        </a>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('courses.destroy', $course->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        No courses found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
