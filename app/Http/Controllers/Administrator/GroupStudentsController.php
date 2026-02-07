<?php

namespace App\Http\Controllers\Administrator;


use App\Http\Controllers\Controller;

class GroupStudentsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $courses = $user->studentGroups()->with('course')->get()->pluck('course')->unique();
        return view('students.courses', compact('courses'));
    }
}
