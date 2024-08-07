@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Manage User Permissions</h1>

    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Permissions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->division ? $user->division->name : '-' }}</td>
                    <td>{{ $user->position ? $user->position->name : '-' }}</td>
                    <td>
                        <!-- Tombol Detail Permission -->
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#permissionModal{{ $user->id }}" data-user-id="{{ $user->id }}">
                            Detail Permission
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Detail Permission -->
@foreach ($users as $user)
<div class="modal fade" id="permissionModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permissionModalLabel{{ $user->id }}">Update Permissions for {{ $user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="permissionForm{{ $user->id }}" action="{{ route('admin.user-permissions.update', ['userId' => $user->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $user->id }}_{{ $permission->id }}" {{ $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission_{{ $user->id }}_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Saat modal ditampilkan
        $('[data-toggle="modal"]').on('click', function () {
            var userId = $(this).data('user-id');
            var modal = $('#permissionModal' + userId);

            // Update form action dengan ID user
            var form = modal.find('form');
            form.attr('action', form.attr('action').replace('__userId__', userId));

            // Ambil permissions berdasarkan user ID
            $.ajax({
                url: '/admin/user-permissions/' + userId + '/edit',
                method: 'GET',
                success: function(data) {
                    // Reset semua checkbox
                    form.find('input[type="checkbox"]').prop('checked', false);

                    // Check permission yang dimiliki user berdasarkan divisi
                    data.permissions.forEach(function(permission) {
                        form.find('#permission_' + userId + '_' + permission.id).prop('checked', true);
                    });
                }
            });
        });

        // Reset modal setelah ditutup
        $('.modal').on('hidden.bs.modal', function () {
            // Reset form ketika modal ditutup
            var form = $(this).find('form');
            form.find('input[type="checkbox"]').prop('checked', false);
        });
    });
</script>
@endsection
