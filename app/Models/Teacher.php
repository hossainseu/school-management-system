<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'teacher_id',
        'email',
        'phone',
        'subject',
        'qualification',
        'joining_date',
        'address',
    ];
}