<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupStudent extends Pivot
{
    protected $table = 'group_students';

    protected $fillable = [
        'group_id',
        'student_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
