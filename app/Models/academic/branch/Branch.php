<?php

namespace App\Models\academic\branch;

use App\Models\academic\course\Course;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'course_branches';
    protected $fillable = ['branch_name',
        'course_id',];

     public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
