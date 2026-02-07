@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Group Details</h2>

        <table class="table table-bordered">
            <tr><th>Name</th><td>{{ $group->name }}</td></tr>
            <tr><th>Course</th><td>{{ $group->course->title }}</td></tr>
            <tr><th>Teacher</th><td>{{ $group->teacher->name }}</td></tr>
            <tr><th>Status</th><td>{{ $group->status ? 'Active' : 'Inactive' }}</td></tr>
            <tr><th>Hours</th><td>{{ $group->hours }}</td></tr>
            <tr><th>Days</th><td>{{ implode(', ', $group->days ?? []) }}</td></tr>
        </table>

        <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('groups.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
