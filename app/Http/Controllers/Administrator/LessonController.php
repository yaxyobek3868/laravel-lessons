<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Request\LessonRequest;
use App\Models\Lesson;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $lessons = Lesson::with('group')
            ->forUser($user)
            ->get();

        return view('lessons.index', compact('lessons'));
    }

    public function create(): View
    {
        $groups = $this->getAccessibleGroups();
        abort_if($groups->isEmpty(), 403);

        return view('lessons.create', compact('groups'));
    }

    public function store(LessonRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('lessons', 'public');
        }

        Lesson::create($data);

        return redirect()->route('lessons.index')
            ->with('success', 'Lesson created successfully');
    }

    public function edit(Lesson $lesson): View
    {
        $this->authorizeLessonAccess($lesson);

        $groups = $this->getAccessibleGroups();

        return view('lessons.edit', compact('lesson', 'groups'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $this->authorizeLessonAccess($lesson);

        $data = $request->validated();

        if ($request->hasFile('file')) {
            
            if ($lesson->file) {
                Storage::disk('public')->delete($lesson->file);
            }
            $data['file'] = $request->file('file')->store('lessons', 'public');
        }

        $lesson->update($data);

        return redirect()->route('lessons.index')
            ->with('success', 'Lesson updated successfully');
    }

    public function destroy(Lesson $lesson)
    {
        $this->authorizeLessonAccess($lesson);

        if ($lesson->file) {
            Storage::disk('public')->delete($lesson->file);
        }

        $lesson->delete();

        return redirect()->route('lessons.index')
            ->with('success', 'Lesson deleted successfully');
    }

    private function getAccessibleGroups()
    {
        $user = Auth::user();

        return match (true) {
            $user->role->isAdmin() => Group::all(),
            $user->role->isTeacher() => Group::where('teacher_id', $user->id)->get(),
            default => collect(),
        };
    }

    private function authorizeLessonAccess(Lesson $lesson)
    {
        $user = Auth::user();

        if ($user->role->isTeacher() && $lesson->group->teacher_id !== $user->id) {
            abort(403);
        }
    }
}