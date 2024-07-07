@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Role: {{ $role->name }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.akses.role.update', $role->id) }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Role Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $role->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <div id="permissionsCheckboxes">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
