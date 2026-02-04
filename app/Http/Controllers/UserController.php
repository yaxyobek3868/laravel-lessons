<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Bu controllerga faqat login qilgan admin foydalanuvchilar kirishi mumkin
        $this->middleware(['auth', 'role:admin']);
    }

    // Users ro'yxati
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // User yaratish formasi
    public function create()
    {
        return view('users.create');
    }

    // User saqlash
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email'=> $validated['email'],
            'password'=> Hash::make($validated['password']),
            'role'=> $validated['role'], // UserRole enum bilan ishlash mumkin
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully.');
    }

    // User tahrirlash formasi
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // User yangilash
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'email'=> $validated['email'],
            'role'=> $validated['role'],
        ];

        // Agar password berilgan bo‘lsa, hash qilib saqlash
        if(!empty($validated['password'])){
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully.');
    }

    // User o‘chirish
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }
}
