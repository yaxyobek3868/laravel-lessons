@extends('layouts.app')

@section('content')
    <div class="card mt-3">
        
        <h2 class="card-header alert alert-info">{{ __('messages.create_group') }}</h2>
        

        <div class="card-body">
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label>{{ __('messages.group_name') }}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label>{{ __('messages.course') }}</label>
                                <select name="course_id" class="form-control">
                                    <option value="">{{ __('messages.select_course') }}</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("course_id")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label>{{ __('messages.teacher') }}</label>
                                <select name="teacher_id" class="form-control">
                                    <option value="">{{ __('messages.select_teacher') }}</option>
                                    @foreach($teachersAndStudents as $teacher)
                                        @if($teacher->role->isTeacher())
                                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error("teacher_id")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label>{{ __('messages.days') }}</label><br>
                                
                                @php
                                    $dayKeys = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                                    $dayValues = ['Mon','Tue','Wed','Thu','Fri','Sat'];
                                @endphp
                                
                                @foreach($dayKeys as $index => $dayKey)
                                    <label class="me-2">
                                        <input type="checkbox" name="days[]" value="{{ $dayValues[$index] }}" 
                                            {{ in_array($dayValues[$index], old('days', [])) ? 'checked' : '' }}> 
                                        {{ __('messages.' . $dayKey) }}
                                    </label>
                                @endforeach

                                @error('days')
                                    <small class="d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label>{{ __('messages.hours') }}</label>
                                <input type="time" name="hours" class="form-control" value="{{ old('hours') }}">
                                @error('hours')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-4">
                                <label>{{ __('messages.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                        {{ __('messages.active') }}
                                    </option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                        {{ __('messages.inactive') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label>{{ __('messages.students') }}</label><br>
                        
                        @foreach($teachersAndStudents as $student)
                            @if($student->role->isStudent())
                                <label class="me-2">
                                    <input type="checkbox" name="students[]" value="{{ $student->id }}"
                                        {{ in_array($student->id, old('students', [])) ? 'checked' : '' }}> 
                                    {{ $student->name }}
                                </label><br>
                            @endif
                        @endforeach

                        @error('students')
                            <small class="d-block text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
               

                <button class="btn btn-success">{{ __('messages.save') }}</button>
                <a href="{{ route('groups.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
            </form>
        </div>
    </div>
@endsection