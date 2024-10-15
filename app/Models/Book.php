<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'pages',
        'status',
        'library_id', // Ensure this is in fillable if you plan to set it
    ];

    // Define the relationship with the Library model
    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}
