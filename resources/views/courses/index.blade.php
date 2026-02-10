@extends('layouts.app')

@section('content')
<div class="content mt-3">

    
    <div class="d-flex justify-content-between " >
        <h2>{{ __('messages.courses') }}</h2>
        <button type="button" class="btn btn-primary mb-3" 
                data-bs-toggle="modal" 
                data-bs-target="#courseDetailModal"
                data-create-url="{{ route('courses.create') }}">
            {{ __('messages.add_course') }}
        </button>
    </div>

    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.description') }}</th>
                <th>{{ __('messages.created_at') }}</th>
                <th class="text-end">{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->created_at->format('d.m.Y H:i') }}</td>
                    <td class="text-end">

                      
                        <button type="button"
                            class="btn btn-info btn-sm btn-show-course"
                            data-bs-toggle="modal"
                            data-bs-target="#courseDetailModal"
                            data-title="{{ $course->title }}"
                            data-description="{{ $course->description }}"
                            data-created="{{ $course->created_at->format('d.m.Y H:i') }}"
                            data-edit-url="{{ route('courses.edit', $course->id) }}"
                            data-delete-url="{{ route('courses.destroy', $course->id) }}">
                            {{ __('messages.view') }}
                        </button>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        {{ __('messages.no_data') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    
    <div class="modal fade" id="courseDetailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.course_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                
                <div class="modal-body">
                    <p><strong>{{ __('messages.title') }}:</strong> <span id="m_title"></span></p>
                    <p><strong>{{ __('messages.description') }}:</strong> <span id="m_description"></span></p>
                    <p><strong>{{ __('messages.created_at') }}:</strong> <span id="m_created"></span></p>
                </div>

                
                <div class="modal-footer">
                    <a href="#" id="modalCourseEditBtn" class="btn btn-warning">{{ __('messages.edit') }}</a>
                    <form id="modalCourseDeleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                </div>

            </div>
        </div>
    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('courseDetailModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        
        if(btn.dataset.createUrl){
            fetch(btn.dataset.createUrl)
                .then(res => res.text())
                .then(html => {
                    modal.querySelector('.modal-body').innerHTML = html;
                    document.getElementById('modalCourseEditBtn').style.display = 'none';
                    document.getElementById('modalCourseDeleteForm').style.display = 'none';
                });
            return;
        }

        
        document.getElementById('m_title').textContent = btn.dataset.title;
        document.getElementById('m_description').textContent = btn.dataset.description;
        document.getElementById('m_created').textContent = btn.dataset.created;

        
        const editBtn = document.getElementById('modalCourseEditBtn');
        const deleteForm = document.getElementById('modalCourseDeleteForm');

        editBtn.href = btn.dataset.editUrl;
        editBtn.style.display = 'inline-block';

        deleteForm.action = btn.dataset.deleteUrl;
        deleteForm.style.display = 'inline-block';
    });
});
</script>
@endsection
