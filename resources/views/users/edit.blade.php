@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header alert alert-info h4 text-center">{{ __('messages.edit_user') }}</h2>

        <form action="{{ route('users.update', $user->id) }}" class="card-body" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">{{ __('messages.address') }}</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                           value="{{ old('address', $user->address) }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">{{ __('messages.phone') }}</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">{{ __('messages.username') }}</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                           value="{{ old('username', $user->username) }}">
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label for="password" class="form-label">{{ __('messages.password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                          >
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label for="role" class="form-label">{{ __('messages.role') }}</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role', $user->role->name) == $role->name)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
        </form>
    </div>
@endsection