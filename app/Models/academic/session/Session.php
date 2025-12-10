<?php

namespace App\Models\academic\session;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'course_sessions';

    protected $fillable = [
        'session',
        'is_active',
    ];
}
