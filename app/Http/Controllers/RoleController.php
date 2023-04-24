<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles', compact('roles', 'permissions'));
    }
    public function edit($id)
    {
        //    select role where id = $id and all permissions of that role
        $role = Role::findById($id);

        $permissions = $role->permissions;

        //    return json response
        return response()->json([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    // store role
    public function store(Request $request)
    {
        // dd($request->all());
        $role = Role::create(['name' => $request->name]);
        // assign permission to role
        $role->syncPermissions($request->permissions);
        // dd($role->permissions);
        session()->flash('message', 'Role created successfully');
        session()->flash('icon', 'success');
        return redirect()->back();
    }

    // update role
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        // remove all permissions
        $role->revokePermissionTo(Permission::all());
        // assign permission to role
        $role->syncPermissions($request->permissions);
        // dd($role->permissions);
        session()->flash('message', 'Role updated successfully');
        session()->flash('icon', 'success');
        return redirect()->back();
    }

    // delete role
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        session()->flash('message', 'Role deleted successfully');
        session()->flash('icon', 'success');
        return redirect()->back();
    }
}
