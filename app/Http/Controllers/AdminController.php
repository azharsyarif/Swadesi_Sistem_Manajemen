<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('Admins.dashboard');
    }
    public function index()
    {
        $roles = Role::all();
        return view('Admins.akses', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }
//     public function edit($id)
// {
//     $role = Role::findOrFail($id);
//     $permissions = Permission::all();  // Assuming you have a Permission model

//     return view('Admins.editAkses', compact('role', 'permissions'));
// }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string',
        ]);

        Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.akses.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
            'permissions' => 'array',
        ]);
    
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    
        $role->permissions()->sync($request->permissions); // Assuming you have a many-to-many relationship
    
        return redirect()->route('admin.akses.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.akses.index')->with('success', 'Role deleted successfully.');
    }

    public function rolePermissions($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        $allPermissions = Permission::all();
    
        return response()->json([
            'rolePermissions' => $rolePermissions,
            'allPermissions' => $allPermissions,
        ]);
    }
    
    public function editPermissions($id)
    {
        $role = Role::findOrFail($id);
        $allPermissions = Permission::all();
    
        return view('Admins.editPermission', compact('role', 'allPermissions'));
    }
    
    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions);
    
        return redirect()->route('admin.akses.index')->with('success', 'Permissions updated successfully.');
    }
    
}
