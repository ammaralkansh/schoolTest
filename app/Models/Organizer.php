<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait; // Import the CrudTrait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory, CrudTrait; // Include CrudTrait

    protected $fillable = ['name', 'email', 'phone'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
