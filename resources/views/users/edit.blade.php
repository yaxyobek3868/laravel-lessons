@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header alert alert-info h4 text-center">Edit User</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" class="card-body" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-3 col-md-4">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old("username", $user->username) }}">
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-2">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role', $user->role) == $role)>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
