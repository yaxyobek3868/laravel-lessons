@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Create Group</h2>

        <form action="{{ route('groups.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Group Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Course</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Teacher</label>
                <select name="teacher_id" class="form-control">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Hours</label>
                <input type="time" name="hours" class="form-control">
            </div>

            <div class="mb-3">
                <label>Days</label><br>
                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                    <label class="me-2">
                        <input type="checkbox" name="days[]" value="{{ $day }}"> {{ $day }}
                    </label>
                @endforeach
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button class="btn btn-success">Save</button>
            <a href="{{ route('groups.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
