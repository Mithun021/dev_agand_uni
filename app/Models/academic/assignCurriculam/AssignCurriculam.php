<?php

namespace App\Models\academic\assignCurriculam;

use App\Models\academic\branch\Branch;
use App\Models\academic\course\Course;
use App\Models\academic\institute\Institute;
use App\Models\academic\scheme\Scheme;
use App\Models\academic\session\Session;
use Illuminate\Database\Eloquent\Model;

class AssignCurriculam extends Model
{
    protected $table = 'course_assign_curriculams';

    protected $fillable = [
        'course_id',
        'branch_id',
        'course_type',
        'session_id',
        'scheme_id',
        'institute_id',
        'semester_id',
        'annual_id',
    ];

    protected $casts = [
        'session_id'   => 'array',
        'scheme_id'    => 'array',
        'institute_id' => 'array',
        'semester_id'  => 'array',
        'annual_id'    => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
}
