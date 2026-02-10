@extends('layouts.app')

@section('content')

<div class="card mt-5">
    <h2 class="card-header alert alert-info h4 text-center">{{ __('messages.create_user') }}</h2>
    <form action="{{ route('users.store') }}" class="card-body" method="POST">
        @csrf

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label">{{ __('messages.address') }}</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                       value="{{ old('address') }}">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label">{{ __('messages.phone') }}</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                       value="{{ old('phone') }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-4">
                <label for="email" class="form-label">{{ __('messages.email') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label class="form-label">{{ __('messages.username') }}</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                       value="{{ old('username') }}" required>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="password" class="form-label">{{ __('messages.password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-2">
                <label for="role" class="form-label">{{ __('messages.role') }}</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">{{ __('messages.select_role') }}</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" @selected(old('role') == $role->name)>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.create') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>
@endsection