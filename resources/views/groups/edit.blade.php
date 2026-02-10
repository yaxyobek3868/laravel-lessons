@extends('layouts.app')

@section('content')
<div class="card mt-3">
    <h2 class="card-header alert alert-info">{{ __('messages.edit_group') }}</h2>

    <div class="card-body">
        <form action="{{ route('groups.update', $group->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        
                        <div class="mb-3 col-md-4">
                            <label for="name" class="form-label">{{ __('messages.group_name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $group->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        
                        <div class="mb-3 col-md-4">
                            <label for="course_id" class="form-label">{{ __('messages.course') }}</label>
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="">{{ __('messages.select_course') }}</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id', $group->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                      
                        <div class="mb-3 col-md-4">
                            <label for="teacher_id" class="form-label">{{ __('messages.teacher') }}</label>
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                <option value="">{{ __('messages.select_teacher') }}</option>
                                @foreach($teachersAndStudents as $teacher)
                                    @if($teacher->role->isTeacher())
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id', $group->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="mb-3 col-md-4">
                            <label class="form-label">{{ __('messages.days') }}</label><br>
                            @php
                                $dayKeys = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                                $dayValues = ['Mon','Tue','Wed','Thu','Fri','Sat'];
                                $selectedDays = old('days', json_decode($group->days) ?? []);
                            @endphp
                            
                            @foreach($dayKeys as $index => $dayKey)
                                <label class="me-2">
                                    <input type="checkbox" name="days[]" value="{{ $dayValues[$index] }}"
                                        {{ in_array($dayValues[$index], $selectedDays) ? 'checked' : '' }}>
                                    {{ __('messages.' . $dayKey) }}
                                </label>
                            @endforeach
                            @error('days')
                                <small class="d-block text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label for="hours" class="form-label">{{ __('messages.hours') }}</label>
                            <input type="time" name="hours" id="hours" class="form-control" value="{{ old('hours', $group->hours) }}">
                            @error('hours')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label for="status" class="form-label">{{ __('messages.status') }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $group->status) == '1' ? 'selected' : '' }}>
                                    {{ __('messages.active') }}
                                </option>
                                <option value="0" {{ old('status', $group->status) == '0' ? 'selected' : '' }}>
                                    {{ __('messages.inactive') }}
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

                
                <div class="col-md-4">
                    <label class="form-label">{{ __('messages.students') }}</label>
                    <div class="border p-2" style="max-height: 300px; overflow-y: auto;">
                        @foreach($teachersAndStudents as $student)
                            @if($student->role->isStudent())
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="students[]" value="{{ $student->id }}" id="student-{{ $student->id }}"
                                        {{ in_array($student->id, old('students', $groupStudent)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="student-{{ $student->id }}">
                                        {{ $student->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @error('students')
                        <small class="d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

           
            <button class="btn btn-primary mt-3">{{ __('messages.update') }}</button>
            <a href="{{ route('groups.index') }}" class="btn btn-secondary mt-3">{{ __('messages.back') }}</a>
        </form>
    </div>
</div>
@endsection