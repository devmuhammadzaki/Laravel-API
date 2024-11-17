<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $role = Role::create(['name' => $request->name]);
        return response()->json($role, 201);
    }

    public function show(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return response()->json($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted']);
    }

    public function assignPermission(Role $role, Request $request)
    {
        $permission = Permission::findByName($request->permission, 'api');

        if (!$permission) {
            return response()->json(['error' => 'Permission not found'], 404);
        }

        $role->givePermissionTo($permission);

        return response()->json(['message' => 'Permission assigned successfully']);
    }
}
