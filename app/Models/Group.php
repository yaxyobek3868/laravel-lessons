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
        'teacher_id',
        'status',
        'hours',
        'days',
    ];


    protected $casts = [
        'days' => 'array',
        'status' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

   
    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'group_students',
            'group_id',
            'student_id'
        );
    }


   
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
