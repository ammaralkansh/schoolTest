<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id(); // حقل معرف فريد
            $table->string('name'); // اسم المكتبة
            $table->text('description')->nullable(); // وصف المكتبة (اختياري)
            $table->string('location')->nullable(); // موقع المكتبة (اختياري)
            $table->enum('status', ['open', 'closed'])->default('open'); // حالة المكتبة
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
        Schema::dropIfExists('libraries');
    }
}
