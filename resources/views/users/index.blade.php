@extends('layouts.app')

@section('content')
<div class="content mt-3">

    
    <div class="d-flex justify-content-between mb-3">
        <h2>{{ __('messages.teachers_students') }}</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            {{ __('messages.create') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.phone') }}</th>
                <th>{{ __('messages.address') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.role') }}</th>
                <th>{{ __('messages.created_at') }}</th>
                <th class="text-end">{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                <td class="text-end">

                  
                    <button type="button"
                            class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#userDetailModal"
                            data-name="{{ $user->name }}"
                            data-address="{{ $user->address }}"
                            data-phone="{{ $user->phone }}"
                            data-email="{{ $user->email }}"
                            data-username="{{ $user->username }}"
                            data-role="{{ $user->role->name }}"
                            data-created="{{ $user->created_at->format('d.m.Y H:i') }}"
                            data-updated="{{ $user->updated_at->format('d.m.Y H:i') }}"
                            data-edit-url="{{ route('users.edit', $user->id) }}"
                            data-delete-url="{{ route('users.destroy', $user->id) }}">
                        {{ __('messages.view') }}
                    </button>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">{{ __('messages.no_data') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>


<div class="modal fade" id="userDetailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

           
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user_details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            
            <div class="modal-body">
                <p><strong>{{ __('messages.name') }}:</strong> <span id="m_name"></span></p>
                <p><strong>{{ __('messages.address') }}:</strong> <span id="m_address"></span></p>
                <p><strong>{{ __('messages.phone') }}:</strong> <span id="m_phone"></span></p>
                <p><strong>{{ __('messages.email') }}:</strong> <span id="m_email"></span></p>
                <p><strong>{{ __('messages.username') }}:</strong> <span id="m_username"></span></p>
                <p><strong>{{ __('messages.role') }}:</strong> <span id="m_role"></span></p>
                <p><strong>{{ __('messages.created_at') }}:</strong> <span id="m_created"></span></p>
                <p><strong>{{ __('messages.updated_at') }}:</strong> <span id="m_updated"></span></p>
            </div>

            
            <div class="modal-footer">

                
                <a href="#" id="modalEditBtn" class="btn btn-warning">
                    {{ __('messages.edit') }}
                </a>

                
                <form id="modalDeleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                   <button type="submit" class="btn btn-danger">
                        {{ __('messages.delete') }}
                    </button>
                </form>

                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('messages.close') }}
                </button>

            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('userDetailModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

      
        document.getElementById('m_name').textContent = btn.dataset.name;
        document.getElementById('m_address').textContent = btn.dataset.address;
        document.getElementById('m_phone').textContent = btn.dataset.phone;
        document.getElementById('m_email').textContent = btn.dataset.email;
        document.getElementById('m_username').textContent = btn.dataset.username;
        document.getElementById('m_role').textContent = btn.dataset.role;
        document.getElementById('m_created').textContent = btn.dataset.created;
        document.getElementById('m_updated').textContent = btn.dataset.updated;

        
        document.getElementById('modalEditBtn').href = btn.dataset.editUrl;

        
        document.getElementById('modalDeleteForm').action = btn.dataset.deleteUrl;
    });
});
</script>
@endsection
