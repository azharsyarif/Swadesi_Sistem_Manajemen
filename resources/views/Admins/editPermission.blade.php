@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Permissions for Role: {{ $role->name }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.akses.role.updatePermissions', $role->id) }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <div id="permissionsCheckboxes">
                                @if ($allPermissions->isEmpty())
                                    <p>No permissions available.</p>
                                @else
                                    @foreach ($allPermissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
