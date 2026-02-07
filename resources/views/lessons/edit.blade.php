@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Edit Lesson</h2>

        <form action="{{ route('lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Group</label>
                <select name="group_id" class="form-control">
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}"
                            {{ $lesson->group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="text" name="title" class="form-control mb-3"
                   value="{{ $lesson->title }}">

            <textarea name="content" class="form-control mb-3" rows="5">
{{ $lesson->content }}
        </textarea>

            <div class="mb-3">
                <label>File</label>
                @if($lesson->file)
                    <div class="mb-2">
                        <a href="{{ asset('storage/'.$lesson->file) }}" target="_blank">
                            Current file
                        </a>
                    </div>
                @endif
                <input type="file" name="file" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
