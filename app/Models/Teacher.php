<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = ['name', 'email','specialization','day','from','to','rate','notes','subject_id','image'];
    public function subject()
{
    return $this->belongsTo(Subject::class);
}
public function setImageAttribute($value)
{
    $attribute_name = "image";
    $disk = "public";
    $destination_path = "uploads/images/teachers";

    $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
}





}
