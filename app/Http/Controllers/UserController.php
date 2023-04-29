<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasPermissionTo('view users') == false) {
            abort(403);
        } else {
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
            return view('users', compact('users', 'roles'));
        }
    }

    public function deletedUsers()
    {
        // get all deleted users
        $users = User::onlyTrashed()->get();
        // get all roles
        $roles = Role::all();
        // return view
        return view('deleted_users', compact('users', 'roles'));
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
        // get user and role even if user is deleted
        $user = User::withTrashed()->find($id);
        $role = $user->roles->first()->name;

        // return ajax response with user data and role of user
        return response()->json([
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

            return redirect()->back();
        } else {
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
        if (auth()->user()->hasPermissionTo('delete deleted users') == false) {
            abort(403);
        }
        // get user
        $user = User::withTrashed()->find($id);
        // force delete user
        $user->forceDelete();
        // return view flash success message
        session()->flash('message', 'User deleted successfully');
        session()->flash('icon', 'success');

        return redirect()->back();
    }
    public function destroy(string $id)
    {
        // soft delete the user with id
        User::find($id)->delete();
        // remove all roles
        // $user->removeRole($user->roles->first()->name);




        session()->flash('message', 'User deleted successfully');
        session()->flash('icon', 'success');

        return redirect()->back();
    }
}
