<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait; // استيراد CrudTrait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, CrudTrait; // استخدام CrudTrait

    protected $table = 'students'; // Table name if not using Laravel conventions
    protected $fillable = [
        'name',
        'age',
        'country',
        'phone',
        'email', // إضافة البريد الإلكتروني
        'date_of_birth',
        'status',
        'classroom_id',
    ];

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
