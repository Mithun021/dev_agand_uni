<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Institute extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'institutes';
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'sort_name',
        'email',
        'phone',
        'password',
    ];
    // Hidden attributes when converting to array or JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

     /**
     * Hash password automatically when setting it
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
