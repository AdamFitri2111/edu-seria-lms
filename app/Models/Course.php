<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'code', 'description', 'category',
        'level', 'status', 'thumbnail', 'educator_id', 'duration_weeks',
    ];

    public function educator()
    {
        return $this->belongsTo(User::class, 'educator_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function learners()
    {
        return $this->belongsToMany(User::class, 'enrollments')
                    ->withPivot('progress', 'status')
                    ->withTimestamps();
    }
}