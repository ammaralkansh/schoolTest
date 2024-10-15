<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id',
        'teacher_id',
        'organizer_id',
        'level',
        'stage',
        'duration',
        'min_students',
        'max_students',
        'start_date',
        'end_date',
        'course_type',
        'number_of_lessons',
        'status',
        'whatsapp_group',
    ];
    
    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
    

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot('payment_status', 'payment_date');
    }
}
