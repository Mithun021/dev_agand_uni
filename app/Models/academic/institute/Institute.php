<?php

namespace App\Models\academic\institute;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'course_institutes';

    protected $fillable = [
        'institute',
        'is_active',
    ];
}
