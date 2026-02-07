@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Edit Group</h2>

        <form action="{{ route('groups.update', $group->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" class="form-control mb-3"
                   value="{{ $group->name }}">

            <select name="course_id" class="form-control mb-3">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ $group->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>

            <select name="teacher_id" class="form-control mb-3">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ $group->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>

            <input type="time" name="hours" class="form-control mb-3"
                   value="{{ $group->hours }}">

            <div class="mb-3">
                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                    <label class="me-2">
                        <input type="checkbox" name="days[]"
                               value="{{ $day }}"
                            {{ in_array($day, $group->days ?? []) ? 'checked' : '' }}>
                        {{ $day }}
                    </label>
                @endforeach
            </div>

            <select name="status" class="form-control mb-3">
                <option value="1" {{ $group->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$group->status ? 'selected' : '' }}>Inactive</option>
            </select>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('groups.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
