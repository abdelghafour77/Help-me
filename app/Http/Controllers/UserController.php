<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\LogController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log = new LogController();
        if (auth()->user()->hasPermissionTo('view users')) {

            // get all users except users that has super admin role or role admin
            if (auth()->user()->hasRole('admin')) {
                $users = User::whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'super admin')->orWhere('name', 'admin');
                })->get();
            } else if (auth()->user()->hasRole('super admin')) {
                $users = User::all();
            }
            // get all roles
            $roles = Role::all();
            // return view
            $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed users", "GET", request()->ip());
            return view('users', compact('users', 'roles'));
        } else {
            $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view users", "GET", request()->ip());
            session()->flash('message', 'You are not allowed to view users');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    public function deletedUsers()
    {
        $log = new LogController();
        if (auth()->user()->hasPermissionTo('view deleted users')) {
            $users = User::onlyTrashed()->get();
            $roles = Role::all();
            $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed deleted users", "GET", request()->ip());
            return view('deleted_users', compact('users', 'roles'));
        } else {
            $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view deleted users", "GET", request()->ip());
            session()->flash('message', 'You are not allowed to view deleted users');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $log = new LogController();
        if (auth()->user()->hasPermissionTo('view users')) {

            // get user and role even if user is deleted
            $user = User::withTrashed()->find($id);
            $role = $user->roles->first()->name;

            $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed user", "GET", request()->ip());
            return response()->json([
                'user' => $user,
                'role' => $role
            ]);
        } else {
            $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view user", "GET", request()->ip());
            session()->flash('message', 'You are not allowed to view users');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $log = new LogController();
        if (auth()->user()->hasPermissionTo('update users')) {
            $user = User::find($id);
            $user->update($request->all());
            // update image if exists
            if ($request->hasFile('image')) {
                $user->update([
                    'image' => $request->image->store('image/user', 'public')
                ]);
            }
            // remove all roles
            $user->removeRole($user->roles->first()->name);
            // assign role
            $user->assignRole($request->role);
            // update user

            // return view flash success message
            session()->flash('message', 'User updated successfully');
            session()->flash('icon', 'success');
            $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " updated user", "PUT", request()->ip());
            return redirect()->back();
        } else {
            $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to update user", "PUT", request()->ip());
            // return view flash success message
            session()->flash('message', 'You are not authorized to update users');
            session()->flash('icon', 'error');
            redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDeleteUser(string $id)
    {
        $log = new LogController();
        if (auth()->user()->hasPermissionTo('delete deleted users')) {


            // get user
            $user = User::withTrashed()->find($id);
            // force delete user
            $user->forceDelete();
            // return view flash success message
            session()->flash('message', 'User deleted successfully');
            session()->flash('icon', 'success');
            $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " deleted user", "DELETE", request()->ip());
            return redirect()->back();
        } else {
            $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to delete user", "DELETE", request()->ip());
            // return view flash success message
            session()->flash('message', 'You are not authorized to delete users');
            session()->flash('icon', 'error');
            redirect()->back();
        }
    }
    public function destroy(string $id)
    {
        $log = new LogController();
        if (auth()->user()->hasPermissionTo('delete users')) {
            // get user
            $user = User::find($id);
            // delete user
            $user->delete();
            // return view flash success message
            session()->flash('message', 'User deleted successfully');
            session()->flash('icon', 'success');
            $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " deleted user", "DELETE", request()->ip());
            return redirect()->back();
        } else {
            $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to delete user", "DELETE", request()->ip());
            // return view flash success message
            session()->flash('message', 'You are not authorized to delete users');
            session()->flash('icon', 'error');
            redirect()->back();
        }
    }
}
