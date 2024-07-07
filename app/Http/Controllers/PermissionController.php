<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('Admins.permission', compact('permissions', 'roles'));
    }

}
