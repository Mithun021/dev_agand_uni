<?php

namespace App\Models\academic\scheme;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
      protected $table = 'course_schemes';
    // Mass assignable attributes
    protected $fillable = [
        'name',
    ];
}
