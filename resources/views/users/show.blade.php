@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <div class="card-header">
        <h2>User Detail {{ $user->name }}</h2>
    </div>

    <div class="card-body">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Name:</strong> {{ $user->address }}</p>
        <p><strong>Name:</strong> {{ $user->phone }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Role:</strong> {{ $user->role->name }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>Updated At:</strong> {{ $user->updated_at->format('d.m.Y H:i') }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
