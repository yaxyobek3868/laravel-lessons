<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'status',
        'password',
        'role',
        "status",
        "phone",
        "address",
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'role' => UserRole::class,
        ];
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

}
