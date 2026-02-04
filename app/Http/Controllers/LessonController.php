<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,teacher');
    }

    public function index()
    {
        $lessons = auth()->user()->isTeacher()
            ? Lesson::whereHas('course', fn($q) => $q->where('teacher_id', auth()->id()))->get()
            : Lesson::all();

        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = auth()->user()->isTeacher()
            ? Course::where('teacher_id', auth()->id())->get()
            : Course::all();

        return view('lessons.create', compact('courses'));
    }

    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());
        return redirect()->route('lessons.index')->with('success','Lesson created successfully.');
    }

    public function edit(Lesson $lesson)
    {
        $courses = auth()->user()->isTeacher()
            ? Course::where('teacher_id', auth()->id())->get()
            : Course::all();

        return view('lessons.edit', compact('lesson','courses'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return redirect()->route('lessons.index')->with('success','Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('lessons.index')->with('success','Lesson deleted successfully.');
    }
}
