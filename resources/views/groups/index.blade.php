@extends('layouts.app')

@section('content')
<div class="content mt-3">

    
    <div class="d-flex justify-content-between mb-3">
        <h2>{{ __('messages.groups_list') }}</h2>
        <button type="button" class="btn btn-primary" 
                data-bs-toggle="modal" 
                data-bs-target="#groupDetailModal" 
                data-create-url="{{ route('groups.create') }}">
            {{ __('messages.create_group') }}
        </button>
    </div>

 
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>{{ __('messages.id') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.course') }}</th>
                <th>{{ __('messages.teacher') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.days') }}</th>
                <th>{{ __('messages.hours') }}</th>
                <th class="text-end">{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->course->title ?? '-' }}</td>
                <td>{{ $group->teacher->name ?? '-' }}</td>
                <td>
                    <span class="badge {{ $group->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $group->status ? __('messages.active') : __('messages.inactive') }}
                    </span>
                </td>
               <td>
                    @if($group->days)
                        @foreach (json_decode($group->days) as $day)
                            <span>{{ __($day) }}</span>@if(!$loop->last), @endif
                        @endforeach
                    @endif
                </td>

                <td>{{ date("H:i", strtotime($group->hours)) }}</td>
                <td class="text-end">

                    
                    <button type="button" class="btn btn-info btn-sm btn-show-group"
                        data-bs-toggle="modal"
                        data-bs-target="#groupDetailModal"
                        data-name="{{ $group->name }}"
                        data-course="{{ $group->course->title ?? '-' }}"
                        data-teacher="{{ $group->teacher->name ?? '-' }}"
                        data-status="{{ $group->status ? __('messages.active') : __('messages.inactive') }}"
                        data-days="{{ $group->days ? implode(', ', json_decode($group->days)) : '-' }}"
                        data-hours="{{ date('H:i', strtotime($group->hours)) }}"
                        data-students="{{ $group->students ? implode(', ', $group->students->pluck('name')->toArray()) : '-' }}"
                        data-edit-url="{{ route('groups.edit', $group->id) }}"
                        data-delete-url="{{ route('groups.destroy', $group->id) }}">
                        {{ __('messages.view') }}
                    </button>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">{{ __('messages.no_groups_found') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    
    <div class="modal fade" id="groupDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.group_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

               
                <div class="modal-body" id="modalGroupBody">
                    <p><strong>{{ __('messages.group_name') }}:</strong> <span id="m_name"></span></p>
                    <p><strong>{{ __('messages.course') }}:</strong> <span id="m_course"></span></p>
                    <p><strong>{{ __('messages.teacher') }}:</strong> <span id="m_teacher"></span></p>
                    <p><strong>{{ __('messages.status') }}:</strong> <span id="m_status"></span></p>
                    <p><strong>{{ __('messages.schedule_days') }}:</strong> <span id="m_days"></span></p>
                    <p><strong>{{ __('messages.time') }}:</strong> <span id="m_hours"></span></p>
                    <p><strong>{{ __('messages.students') }}:</strong> <span id="m_students"></span></p>
                </div>

                
                <div class="modal-footer">
                    <a href="#" id="modalGroupEditBtn" class="btn btn-warning">{{ __('messages.edit') }}</a>
                    <form id="modalGroupDeleteForm" method="POST" class="d-inline">
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
    const modal = document.getElementById('groupDetailModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        
        if(btn.dataset.createUrl){
            fetch(btn.dataset.createUrl)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('modalGroupBody').innerHTML = html;
                    document.getElementById('modalGroupEditBtn').style.display = 'none';
                    document.getElementById('modalGroupDeleteForm').style.display = 'none';
                });
            return;
        }

       
        document.getElementById('m_name').textContent = btn.dataset.name;
        document.getElementById('m_course').textContent = btn.dataset.course;
        document.getElementById('m_teacher').textContent = btn.dataset.teacher;
        document.getElementById('m_status').textContent = btn.dataset.status;
        document.getElementById('m_days').textContent = btn.dataset.days;
        document.getElementById('m_hours').textContent = btn.dataset.hours;
        document.getElementById('m_students').textContent = btn.dataset.students;

        
        const editBtn = document.getElementById('modalGroupEditBtn');
        const deleteForm = document.getElementById('modalGroupDeleteForm');

        editBtn.href = btn.dataset.editUrl;
        editBtn.style.display = 'inline-block';

        deleteForm.action = btn.dataset.deleteUrl;
        deleteForm.style.display = 'inline-block';
    });
});
</script>
@endsection
