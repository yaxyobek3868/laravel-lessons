<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,teacher');
    }

    public function index()
    {
        $courses = Auth::user()->isTeacher()
            ? Course::where('teacher_id', auth()->id())->get()
            : Course::all();

        return view('courses.index', compact('courses'));
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
