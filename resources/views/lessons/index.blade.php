@extends('layouts.app')

@section('content')
<div class="content mt-3">

   
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('messages.lessons_list') }}</h2>
        <a href="{{ route('lessons.create') }}" class="btn btn-primary" 
           data-bs-toggle="modal" 
           data-bs-target="#lessonDetailModal" 
           data-create-url="{{ route('lessons.create') }}">
            {{ __('messages.add_lesson') }}
        </a>
    </div>

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>{{ __('messages.group') }}</th>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.content') }}</th>
                <th>{{ __('messages.file') }}</th>
                <th>{{ __('messages.created_at') }}</th>
                <th class="text-end">{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->id }}</td>
                    <td>{{ $lesson->group->name ?? '-' }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ Str::limit($lesson->content, 50) }}</td>
                    <td>
                        @if($lesson->file)
                            <a href="{{ Storage::url($lesson->file) }}" target="_blank">
                                {{ __('messages.view_file') }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $lesson->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">

                        
                        <button type="button" class="btn btn-info btn-sm btn-show-lesson"
                                data-bs-toggle="modal"
                                data-bs-target="#lessonDetailModal"
                                data-group="{{ $lesson->group->name ?? '-' }}"
                                data-title="{{ $lesson->title }}"
                                data-content="{{ $lesson->content }}"
                                data-file-url="{{ $lesson->file ? Storage::url($lesson->file) : '' }}"
                                data-created="{{ $lesson->created_at->format('Y-m-d H:i') }}"
                                data-edit-url="{{ route('lessons.edit', $lesson->id) }}"
                                data-delete-url="{{ route('lessons.destroy', $lesson->id) }}">
                            {{ __('messages.view') }}
                        </button>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('messages.no_lessons_found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    
    <div class="modal fade" id="lessonDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

               
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.lesson_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

               
                <div class="modal-body" id="modalLessonBody">
                    <p><strong>{{ __('messages.group') }}:</strong> <span id="m_group"></span></p>
                    <p><strong>{{ __('messages.title') }}:</strong> <span id="m_title"></span></p>
                    <p><strong>{{ __('messages.content') }}:</strong> <span id="m_content"></span></p>
                    <p><strong>{{ __('messages.file') }}:</strong> <span id="m_file"></span></p>
                    <p><strong>{{ __('messages.created_at') }}:</strong> <span id="m_created"></span></p>
                </div>

                
                <div class="modal-footer">
                    <a href="#" id="modalLessonEditBtn" class="btn btn-warning">{{ __('messages.edit') }}</a>
                    <form id="modalLessonDeleteForm" method="POST" class="d-inline">
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
    const modal = document.getElementById('lessonDetailModal');
    const modalBody = document.getElementById('modalLessonBody');

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        
        if(btn.dataset.createUrl){
            fetch(btn.dataset.createUrl)
                .then(res => res.text())
                .then(html => {
                    modalBody.innerHTML = html;
                    document.getElementById('modalLessonEditBtn').style.display = 'none';
                    document.getElementById('modalLessonDeleteForm').style.display = 'none';
                });
            return;
        }

        
        document.getElementById('m_group').textContent = btn.dataset.group;
        document.getElementById('m_title').textContent = btn.dataset.title;
        document.getElementById('m_content').textContent = btn.dataset.content;
        document.getElementById('m_file').innerHTML = btn.dataset.fileUrl 
            ? '<a href="'+btn.dataset.fileUrl+'" target="_blank">{{ __("messages.view_file") }}</a>' 
            : '-';
        document.getElementById('m_created').textContent = btn.dataset.created;

       
        const editBtn = document.getElementById('modalLessonEditBtn');
        const deleteForm = document.getElementById('modalLessonDeleteForm');

        editBtn.href = btn.dataset.editUrl;
        editBtn.style.display = 'inline-block';

        deleteForm.action = btn.dataset.deleteUrl;
        deleteForm.style.display = 'inline-block';
    });
});
</script>
@endsection
