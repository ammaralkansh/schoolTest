<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'classroom_id',
        // Add other fields here as needed
    ];
}
