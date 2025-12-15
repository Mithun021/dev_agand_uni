<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'course_id',
        'name',
    ];
    
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
