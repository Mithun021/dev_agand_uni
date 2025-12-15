<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    protected $table = 'schemes';
    // Mass assignable attributes
    protected $fillable = [
        'name',
    ];
}
