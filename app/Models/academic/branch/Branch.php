<?php

namespace App\Models\academic\branch;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'course_branches';
    protected $fillable = ['branch_name'];
}
