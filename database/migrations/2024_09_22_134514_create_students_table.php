<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age'); // إضافة حقل العمر
            $table->string('country'); // إضافة حقل الدولة
            $table->string('phone')->nullable(); // إضافة حقل الهاتف
            $table->string('email')->unique(); // التأكد من أن البريد الإلكتروني فريد
            $table->date('date_of_birth')->nullable(); // إضافة حقل تاريخ الميلاد
            $table->enum('status', ['active', 'paused', 'ended'])->default('active'); // حالات مبسطة
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للصف
            $table->timestamps();
        });

        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للطالب
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للمقرر
            $table->timestamps();
        });

        Schema::create('student_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للطالب
            $table->string('message'); // حقل الرسالة
            $table->boolean('is_read')->default(false); // حالة القراءة
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('course_student');
        Schema::dropIfExists('student_notifications');
    }
};
