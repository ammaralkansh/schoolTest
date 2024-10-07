<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'students'; // Optional, only if your table name does not follow Laravel's naming convention

    // Define any relationships or other methods as needed
}
 

