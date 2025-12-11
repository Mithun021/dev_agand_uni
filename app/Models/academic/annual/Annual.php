<?php

namespace App\Models\academic\annual;

use Illuminate\Database\Eloquent\Model;

class Annual extends Model
{
     protected $table = 'course_annuals';

    protected $fillable = [
        'year',
    ];
}
