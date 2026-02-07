<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Profile;
use app\Models\Course;


class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'username',
        'status',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    // User → Profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Teacher → Courses
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // Teacher → Groups
    public function groups()
    {
        return $this->hasMany(Group::class, 'teacher_id');
    }

    // Student → Groups (pivot)
    public function studentGroups()
    {
        return $this->belongsToMany(
            Group::class,
            'group_students',
            'student_id',
            'group_id'
        );
    }

  

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
