@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Groups List</h2>
            <a href="{{ route('groups.create') }}" class="btn btn-primary">Create Group</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Teacher</th>
                <th>Status</th>
                <th>Hours</th>
                <th>Days</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->course->title ?? '-' }}</td>
                    <td>{{ $group->teacher->name ?? '-' }}</td>
                    <td>
                    <span class="badge {{ $group->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $group->status ? 'Active' : 'Inactive' }}
                    </span>
                    </td>
                    <td>{{ $group->hours }}</td>
                    <td>{{ implode(', ', $group->days ?? []) }}</td>
                    <td>
                        <a href="{{ route('groups.show', $group->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('groups.destroy', $group->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No groups found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
