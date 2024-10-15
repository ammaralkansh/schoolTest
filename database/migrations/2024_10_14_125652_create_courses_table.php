<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // تحقق مما إذا كان الجدول موجودًا بالفعل
        if (!Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي لموضوع
                $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للمعلم
                $table->foreignId('organizer_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للمنظم
                $table->enum('level', ['المستوى الأول', 'المستوى الثاني', 'المستوى الثالث']);
                $table->enum('stage', ['المرحلة الأولى', 'المرحلة الثانية', 'المرحلة الثالثة']);
                $table->integer('duration');
                $table->integer('min_students');
                $table->integer('max_students');
                $table->date('start_date');
                $table->date('end_date');
                $table->enum('course_type', ['جماعية', 'خاصة']);
                $table->integer('number_of_lessons');
                $table->enum('status', ['نشطة', 'متوقفة', 'منتهية']);
                $table->boolean('whatsapp_group')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses'); // حذف الجدول عند التراجع
    }
};
