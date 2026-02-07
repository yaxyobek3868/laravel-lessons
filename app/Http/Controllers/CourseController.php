<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Http\Request\CourseRequest;
use Illuminate\Support\Facades\Auth;
use app\Enums\UserRole;

class CourseController extends Controller
{

    public function index()
    {
        $p = UserRole::person();


        $cousre =  Course::where('teacher_id', Auth::id())->get();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $teachers = User::where('role','teacher')->get();
        return view('courses.create', compact('teachers'));
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->validated());
        return redirect()->route('courses.index')->with('success','Course created successfully.');
    }

    public function edit(Course $course)
    {
        $teachers = User::where('role','teacher')->get();
        return view('courses.edit', compact('course','teachers'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return redirect()->route('courses.index')->with('success','Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success','Course deleted successfully.');
    }
}
