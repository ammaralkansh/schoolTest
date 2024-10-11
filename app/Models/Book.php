<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait; // تأكد من استيراد CrudTrait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, CrudTrait; // تأكد من استخدام CrudTrait هنا

    protected $fillable = [
        'title',       // عنوان الكتاب
        'price',       // سعر الكتاب
        'pages',       // عدد الصفحات
        'status',      // حالة الكتاب (موجود أو مستعار)
        'library_id',  // معرف المكتبة (لربط الكتاب بالمكتبة)
    ];

    // علاقة الكتاب بالمكتبة
    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}
