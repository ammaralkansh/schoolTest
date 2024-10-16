<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'subjects';
    // تحديد الحقول القابلة للكتابة
    protected $fillable = ['name','course_price','course_hours']; // يجب إضافة 'name' هنا ليتم التعامل معه بشكل صحيح

    // حماية الحقول الحساسة التي لا يجب تعديلها
    protected $guarded = ['id'];

    public function teachers()
{
    return $this->hasMany(Teacher::class);
}

}
