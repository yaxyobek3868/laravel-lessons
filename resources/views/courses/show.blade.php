@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Course View</h2>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $course->id }}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{ $course->title }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $course->description }}</td>
            </tr>
            <tr>
                <th>Group ID</th>
                <td>{{ $course->group_id }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $course->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        </table>

        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
