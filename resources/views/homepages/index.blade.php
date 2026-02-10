@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="fw-bold mb-3">{{ __('messages.welcome_education_center') }}</h1>
            <p class="mb-4 text-muted">
                {{ __('messages.welcome_description') }}
            </p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary me-2">{{ __('messages.view_courses') }}</a>
            <a href="{{ route('groups.index') }}" class="btn btn-outline-secondary">{{ __('messages.groups') }}</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('assets/img/teacher-4.webp') }}" class="img-fluid" alt="{{ __('messages.education_center') }}">
        </div>
    </div>

    
    <div class="row text-center mt-5">
        <div class="col-md-4 mb-3">
            <h2 class="fw-bold text-primary">10+</h2>
            <p class="text-muted">{{ __('messages.courses') }}</p>
        </div>
        <div class="col-md-4 mb-3">
            <h2 class="fw-bold text-primary">500+</h2>
            <p class="text-muted">{{ __('messages.graduates') }}</p>
        </div>
        <div class="col-md-4 mb-3">
            <h2 class="fw-bold text-primary">20+</h2>
            <p class="text-muted">{{ __('messages.instructors') }}</p>
        </div>
    </div>
</div>
@endsection