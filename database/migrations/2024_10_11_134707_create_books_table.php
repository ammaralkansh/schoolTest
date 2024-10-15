<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // معرف فريد
            $table->string('title'); // اسم الكتاب
            $table->decimal('price', 8, 2); // سعر الكتاب
            $table->integer('pages'); // عدد الصفحات
            $table->enum('status', ['available', 'borrowed']); // حالة الكتاب (متاح أو مستعار)
            $table->foreignId('library_id')->constrained()->onDelete('cascade'); // ربط الكتاب بالمكتبة
            $table->timestamps(); // حقول timestamps (created_at و updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
