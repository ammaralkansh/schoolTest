<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; // Table name if not using Laravel conventions

    // Define relationships
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
