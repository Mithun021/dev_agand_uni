<?php

namespace App\Models\academic\course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course',
        'is_active',
    ];
}
