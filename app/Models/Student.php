<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'student_id',
        'email',
        'phone',
        'class',
        'section',
        'date_of_birth',
        'address',
    ];
    public function results()
    {
        return $this->hasMany(\App\Models\Result::class);
    }
}