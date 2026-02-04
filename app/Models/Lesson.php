<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content'
    ];

    // Lesson → Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
