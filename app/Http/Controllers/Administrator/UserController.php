<?php

namespace App\Http\Controllers\Administrator;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Request\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::whereNot("role", UserRole::Admin)->orderBy("role")->get();
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = UserRole::person();
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name'      => $request->validated()['name'],
            'address'   => $request->validated()['address'],
            'phone'     => $request->validated()['phone'],
            'email'     => $request->validated()['email'],
            'username'  => $request->validated()['username'],
            'password'  => Hash::make($request->validated()['password']),
            'role'      => $request->validated()['role'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function edit(User $user): View
    {
        $roles = UserRole::person();

        return view('users.edit', compact('user', 'roles'));
    }



    public function update(UserRequest $request, User $user)
    {
        $user->fill([
            'name'      => $request->validated()['name'],
            'address'   => $request->validated()['address'],
            'phone'     => $request->validated()['phone'],
            'email'     => $request->validated()['email'],
            'username'  => $request->validated()['username'],
            'role'      => $request->validated()['role'],
        ]);

        if (!empty($data['password'])) {
            $user->fill([
                'password' => Hash::make($request->validated(['password']))
            ]);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
