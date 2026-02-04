<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> bcrypt('admin123'),
            'role' => 'admin',
        ]);
        User::create([
            'name'=> 'test',
            'email'=> 'test@mail.com',
            'password'=> bcrypt('test123'),
            'role'=> 'teacher',
        ]);
        User::create([
            'name'=> 'student',
            'email'=> 'student@gmail.com',
            'password'=> bcrypt('astudent123'),
            'role'=> 'student',
        ]);
    }
}

