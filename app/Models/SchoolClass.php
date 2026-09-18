<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'school_classes';

    protected $fillable = [
        'name',
        'class_code',
        'section',
        'description',
    ];
    public function students()
     { 
        return \App\Models\Student::where('class', $this->name);
     }
}