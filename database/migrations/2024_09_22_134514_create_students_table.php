<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('age');
                $table->string('country');
                $table->string('phone')->nullable();
                $table->string('email')->unique();
                $table->date('date_of_birth')->nullable();
                $table->enum('status', ['active', 'paused', 'ended'])->default('active');
                $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }
    

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
    
};
