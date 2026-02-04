<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'teacher_id'
    ];

    // Group → Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Group → Teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Group → Students
    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'group_students',
            'group_id',
            'student_id'
        );
    }
}
