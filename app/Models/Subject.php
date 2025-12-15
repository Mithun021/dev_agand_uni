<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'course_id',
        'branch_id',
        'semester_id',
        'scheme_id',
        'name',
        'type',
        'subject_code',
        'credits',
        'internal_marks',
        'external_marks',
        'total',
    ];

    /**
     * Relationships
     */

    // Subject belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Subject belongs to a branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Subject belongs to a semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Subject belongs to a scheme
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
