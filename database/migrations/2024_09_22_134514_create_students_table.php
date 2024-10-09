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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('age'); // Add age field
        $table->string('country'); // Add country field
        $table->string('phone')->nullable(); // Add phone field
        $table->enum('status', ['active', 'prospective', 'inactive', 'withdrawn'])->default('active'); // Add status field
        $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('course_student', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('student_notifications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->string('message');
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
