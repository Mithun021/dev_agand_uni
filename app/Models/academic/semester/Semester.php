<?php

namespace App\Models\academic\semester;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'course_semesters';

    protected $fillable = [
        'semester',
    ];
}
