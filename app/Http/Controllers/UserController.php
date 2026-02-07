<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use App\Http\Request\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        
        $roles = UserRole::person();

        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name'     => $request->validated()['name'],
            'email'=> $request->validated()['email'],
            'password'=> Hash::make($request->validated()['password']),
            'role'     => $request->validated()['role'],
            
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
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        $updateData = [
            'name'  => $request->validated()['name'],
            'email'=> $request->validated()['email'],
            'role'  => $request->validated()['role'],
        ];

        
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

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
