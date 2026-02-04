<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Lesson;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teacher_id'
    ];

    // Course → Teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Course → Lessons
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Course → Groups
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
