@extends('layouts.app')
@section('content')
<div class="card mt-5">
    <div class="card">
        <div class="card-header ">
            <h3>{{ __('messages.my_profile') }}</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>{{ __('messages.name') }}:</strong> {{ $user->name }}</p>
                    <p><strong>{{ __('messages.email') }}:</strong> {{ $user->email }}</p>
                    <p><strong>{{ __('messages.role') }}:</strong> {{ $user->role->name }}</p>
                    <p><strong>{{ __('messages.address') }}:</strong> {{ $user->address }}</p>
                    <p><strong>{{ __('messages.phone') }}:</strong> {{ $user->phone }}</p>
                    <p><strong>{{ __('messages.registered_date') }}:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
                </div>

            <div class="mt-4">
                
                <a href="{{ route('homepages.index') }}" class="btn btn-secondary">
                    {{ __('messages.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


