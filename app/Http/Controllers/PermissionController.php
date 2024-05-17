<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'role:admin',
            new Middleware('permission:view permission', only: ['index']),
            new Middleware('permission:create permission', only: ['create', 'store']),
            new Middleware('permission:update permission', only: ['update', 'edit']),
            new Middleware('permission:delete permission', only: ['destroy']),
            // new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
            // new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete records,api'), only:['destroy']),
        ];
    }

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('role-permission.permission.index', [
            'permissions' => $permissions
        ]);
    }
    public function create()
    {
        return view('role-permission.permission.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);
        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permission')->with('status', 'Permission Created Successfully');
    }
    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', [
            'permission' => $permission
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permission')->with('status', 'Permission Updated Successfully');
    }
    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permission')->with('status', 'Permission Deleted Successfully');
    }
}
