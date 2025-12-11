<?php

namespace App\Models\academic\course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course',
        'course_type',
        'semester_id',
        'annual_id',
        'branch_id',
        'is_active',
    ];
     
    public function branch()
    {
        return $this->belongsTo(\App\Models\academic\branch\Branch::class, 'branch_id');
    }

    public function semester()
    {
        return $this->belongsTo(\App\Models\academic\semester\Semester::class, 'semester_id');
    }
    public function annual()
    {
        return $this->belongsTo(\App\Models\academic\annual\Annual::class, 'annual_id');
    }
}
