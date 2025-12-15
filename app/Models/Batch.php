<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batches';
    // Mass assignable attributes
    protected $fillable = [
        'name',
    ];
}
