<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {   
        $users = User::all();
        return view('admin.user.users', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.user.user_create', compact('roles'));
    }

    public function store(Request $request)
    {   
        $validations = $request->validate([
            'name' =>  ['required'],
            'email' =>  ['required','email','unique:users,email'],
            'password' =>  ['required'],
        ]);

        User::create($request->all());

        return redirect(route('users'));
    }

    public function show(User $user)
    {
        return view('admin.user.user_show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.user.user_edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {   
        $validations = $request->validate([
            'name' =>  ['required'],
            'email' =>  ['required','email','unique:users,email,'.$user->id],
            'password' =>  ['required'],
        ]);

        User::where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' =>  $request->role_id,
            'balance' =>  $request->balance,
        ]);

        return redirect(route('users'));
    }

    public function delete(User $user)
    {
        User::destroy($user->id);

        return redirect(route('users'));
    }
}
