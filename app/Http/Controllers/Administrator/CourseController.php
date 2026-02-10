<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Http\Request\CourseRequest;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::get();
        return view('courses.index', compact('courses'));
    }


    public function create()
    {
        $teachers = User::where('role','teacher')->get();
        return view('courses.create', compact('teachers'));
    }

        public function store(CourseRequest $request)
    {
        Course::create([
            'title'       => $request->validated()['title'],
            'description' => $request->validated()['description'],
           
        ]);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully');
    }

    public function edit($course)
    {
         $course = Course::findOrFail($course);
        return view('courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->fill ([
            'title'        => $request->validated()['title'],
            'description'  => $request->validated()['description'],
        ]);
        $course->save();
    }

    public function destroy(Course $course)
   {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'course deleted successfully');
    }
}
