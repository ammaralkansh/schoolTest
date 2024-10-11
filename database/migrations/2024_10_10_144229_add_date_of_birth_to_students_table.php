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
        // تحقق مما إذا كان العمود موجودًا بالفعل
        if (!Schema::hasColumn('students', 'date_of_birth')) {
            Schema::table('students', function (Blueprint $table) {
                $table->date('date_of_birth')->nullable(); // إضافة حقل تاريخ الميلاد
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('date_of_birth'); // حذف حقل تاريخ الميلاد عند التراجع
        });
    }
};
