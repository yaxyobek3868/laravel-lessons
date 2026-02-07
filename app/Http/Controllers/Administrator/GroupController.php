<?php

namespace App\Http\Controllers\Administrator;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Request\GroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GroupController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
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
