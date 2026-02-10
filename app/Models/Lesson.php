<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'title',
        'content',
        'file',
    ];

    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    
    public function scopeForUser($query, $user)
    {
        return match (true) {
            $user->role->isAdmin() => $query,
            $user->role->isTeacher() => $query->whereHas('group', fn($q) => $q->where('teacher_id', $user->id)),
            default => $query->whereRaw('1 = 0'), 
        };
    }
}
