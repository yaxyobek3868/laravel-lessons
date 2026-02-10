<?php

namespace App\Http\Controllers\Administrator;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Request\GroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $groups = $user->role->isAdmin()
            ? Group::with(['teacher', 'students', 'course'])->get()
            : Group::with(['teacher', 'students', 'course'])
                   ->where('teacher_id', $user->id)
                   ->get();
               

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $teachersAndStudents = User::whereIn('role', [UserRole::Teacher, UserRole::Student])->get();
        $courses  = Course::get();

        return view('groups.create', compact('teachersAndStudents', 'courses'));
    }

    public function store(GroupRequest $request)
    {
        $validated = $request->validated();

        $group = Group::create([
            'name'       => $validated['name'],
            'course_id'  => $validated['course_id'],
            'teacher_id' => $validated['teacher_id'],
            'status'     => $validated['status'],
            'hours'      => $validated['hours'],
            'days'       => json_encode($validated['days']),
        ]);

        
        if ($request->has('students')) {
            $group->students()->sync($request->input('students'));
        }

        return redirect()
            ->route('groups.index')
            ->with('success', 'Group created successfully');
    }

    public function edit(Group $group)
    {
        $teachersAndStudents = User::whereIn('role', [UserRole::Teacher, UserRole::Student])->get();
        $courses  = Course::get();

        $groupStudent = GroupStudent::where("group_id", $group->id)->pluck('student_id')->toArray();


        return view('groups.edit', compact(
            'group',
             'teachersAndStudents',
              'courses',
              'groupStudent'
            ));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $validated = $request->validated();

       
        $days = isset($validated['days']) && is_array($validated['days']) 
                ? json_encode($validated['days']) 
                : null;

        $group->update([
            'name'       => $validated['name'],
            'course_id'  => $validated['course_id'],
            'teacher_id' => $validated['teacher_id'],
            'status'     => $validated['status'],
            'hours'      => $validated['hours'],
            'days'       => $days,
        ]);

        
        if ($request->has('students')) {
            $group->students()->sync($request->input('students'));
        } else {
            $group->students()->sync([]); 
        }

        return redirect()
            ->route('groups.index')
            ->with('success', 'Group updated successfully');
    }

    
    public function destroy(Group $group)
    {
       
        $group->students()->detach();

        $group->delete();

        return redirect()
            ->route('groups.index')
            ->with('success', 'Group deleted successfully');
    }
}
