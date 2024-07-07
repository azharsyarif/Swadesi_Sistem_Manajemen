// resources/views/Admins/permission.blade.php
@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Manage Permissions</h1>

    <h2>Create Permission</h2>
    {{-- <form action="{{ route('admin.permission.store') }}" method="POST"> --}}
        @csrf
        <div class="form-group">
            <label for="name">Permission Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Permission</button>
    </form>

    <h2>Assign Permission to Role</h2>
    {{-- <form action="{{ route('admin.permission.assign') }}" method="POST"> --}}
        @csrf
        <div class="form-group">
            <label for="role_id">Role</label>
            <select class="form-control" id="role_id" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="permission_id">Permission</label>
            <select class="form-control" id="permission_id" name="permission_id" required>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Permission</button>
    </form>
</div>
@endsection
