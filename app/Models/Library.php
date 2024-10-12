<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = [
        'name',
        'location',
        'status',
    ];

    // تعريف العلاقة مع نموذج الكتب (Book)
    public function books()
    {
        return $this->belongsToMany(\App\Models\Book::class);
    }
}
