<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use CrudTrait;
    use HasFactory;

    // تحديد الحقول التي يمكن تعيينها جماعياً
    protected $fillable = [
        'name',
        'description',
        'location',
    ];
}
