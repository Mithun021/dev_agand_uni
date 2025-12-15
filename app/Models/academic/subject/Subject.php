<?php

namespace App\Models\academic\subject;

use App\Models\academic\annual\Annual;
use App\Models\academic\branch\Branch;
use App\Models\academic\course\Course;
use App\Models\academic\scheme\Scheme;
use App\Models\academic\semester\Semester;
use App\Models\academic\session\Session;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
      protected $table = 'course_subjects';

    protected $fillable = [
        'course_id',
        'branch_id',
        'course_type',
        'session_id',
        'scheme_id',
        'semester_id',
        'annual_id',
        'subject_name',
        'subject_type',
        'subject_code',
        'credit',
        'internal_marks',
        'external_marks',
        'total',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function annual()
    {
        return $this->belongsTo(Annual::class);
    }
}
