@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Lesson Details</h2>

        <table class="table table-bordered">
            <tr>
                <th>Group</th>
                <td>{{ $lesson->group->name }}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{ $lesson->title }}</td>
            </tr>
            <tr>
                <th>Content</th>
                <td>{{ $lesson->content }}</td>
            </tr>
            <tr>
                <th>File</th>
                <td>
                    @if($lesson->file)
                        <a href="{{ asset('storage/'.$lesson->file) }}" target="_blank">
                            Download
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $lesson->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        </table>

        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
