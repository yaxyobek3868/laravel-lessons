@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Create Lesson</h2>

        <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Group</label>
                <select name="group_id" class="form-control">
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" rows="5" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>File</label>
                <input type="file" name="file" class="form-control">
            </div>

            <button class="btn btn-success">Save</button>
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
