<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Group;
use App\Models\Course;
use App\Models\User;
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $p = UserRole::person();

        dd($p['student']);
        $groups =  Group::where('teacher_id', Auth::id())->get();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $teachers = User::where('role','teacher')->get();
        $courses = Course::get();
        return view('groups.create', compact('teachers','courses'));
    }

    public function store(GroupRequest $request)
    {
        Group::create($request->validated());
        return redirect()->route('groups.index')->with('success','Group created successfully.');
    }

    public function edit(Group $group)
    {
        $teachers = User::where('role','teacher')->get();
        $courses = Course::all();
        return view('groups.edit', compact('group','teachers','courses'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());
        return redirect()->route('groups.index')->with('success','Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success','Group deleted successfully.');
    }

}
