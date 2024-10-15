<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        // Add other attributes here as needed
    ];
}




