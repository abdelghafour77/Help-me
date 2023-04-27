<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('view roles')) {

                $log->logMe("info", "Viewed roles", "GET", request()->ip());
                $roles = Role::all();
                $permissions = Permission::all();
                return view('roles', compact('roles', 'permissions'));
            } else {
                $log->logMe("warning", "Unauthorized access to view roles", "GET", request()->ip());
                session()->flash('message', 'You are not allowed to view roles');
                session()->flash('icon', 'error');
                return redirect("/");
            }
        } else {
            $log->logMe("warning", "must be logged in to view roles", "GET", request()->ip());
            // session icon and message
            session()->flash('message', 'You must be logged in to view roles');
            session()->flash('icon', 'error');
            return redirect("/");
        }
    }
    public function edit($id)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('view roles')) {

                $role = Role::findById($id);
                $permissions = $role->permissions;

                return response()->json([
                    'role' => $role,
                    'permissions' => $permissions
                ]);
            } else {
                $log->logMe("warning", "Unauthorized access to view roles", "GET", request()->ip());
                return response()->json([
                    'message' => 'You are not allowed to view roles',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            $log->logMe("warning", "must be logged in to view roles", "GET", request()->ip());
            return response()->json([
                'message' => 'You must be logged in to view roles',
                'icon' => 'error',
            ], 401);
        }
    }

    // store role
    public function store(Request $request)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('create role')) {
                // dd($request->all());
                $role = Role::create(['name' => $request->name]);
                // assign permission to role
                $role->syncPermissions($request->permissions);
                // dd($role->permissions);
                session()->flash('message', 'Role created successfully');
                session()->flash('icon', 'success');
                return redirect()->back();
            } else {
                $log->logMe("warning", "Unauthorized access to create role", "POST", request()->ip());
                return response()->json([
                    'message' => 'You are not allowed to create role',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            $log->logMe("warning", "must be logged in to create role", "POST", request()->ip());
            return response()->json([
                'message' => 'You must be logged in to create role',
                'icon' => 'error',
            ], 401);
        }
    }

    // update role
    public function update(Request $request, $id)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('edit role')) {
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
            } else {
                $log->logMe("warning", "Unauthorized access to edit role", "POST", request()->ip());
                return response()->json([
                    'message' => 'You are not allowed to edit role',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            $log->logMe("warning", "must be logged in to edit role", "POST", request()->ip());
            return response()->json([
                'message' => 'You must be logged in to edit role',
                'icon' => 'error',
            ], 401);
        }
    }

    // delete role
    public function destroy($id)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('delete role')) {
                $role = Role::findById($id);
                $role->delete();
                session()->flash('message', 'Role deleted successfully');
                session()->flash('icon', 'success');
                return redirect()->back();
            } else {
                $log->logMe("warning", "Unauthorized access to delete role", "POST", request()->ip());
                return response()->json([
                    'message' => 'You are not allowed to delete role',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            $log->logMe("warning", "must be logged in to delete role", "POST", request()->ip());
            return response()->json([
                'message' => 'You must be logged in to delete role',
                'icon' => 'error',
            ], 401);
        }
    }
}
