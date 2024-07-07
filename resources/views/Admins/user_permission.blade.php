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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#permissionModal" data-user-id="{{ $user->id }}">
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
<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permissionModalLabel">Update Permissions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="permissionForm" action="#" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
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
@endsection

@section('scripts')
<script>
    $('#permissionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.data('user-id'); // Extract info from data-* attributes

        // Update form action with the user's ID
        var form = $('#permissionForm');
        form.attr('action', '/admin/user_permissions/' + userId);

        // Get user permissions and set checkboxes
        $.ajax({
            url: '/admin/user_permissions/' + userId + '/edit',
            method: 'GET',
            success: function(data) {
                // Reset all checkboxes
                form.find('input[type="checkbox"]').prop('checked', false);

                // Check the permissions the user already has
                data.permissions.forEach(function(permission) {
                    form.find('#permission_' + permission.id).prop('checked', true);
                });
            }
        });
    });
</script>
@endsection
