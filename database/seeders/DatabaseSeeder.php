<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // تأكد من إضافة هذا الاستيراد
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // حذف البيانات القديمة
    DB::table('users')->truncate();
    DB::table('password_reset_tokens')->truncate();
    DB::table('sessions')->truncate();

    // إضافة بيانات إلى جدول users
    DB::table('users')->insert([
        'name' => 'ammar',
        'email' => 'ammar@rikaz.com',
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make('rikaz'),
        'remember_token' => Str::random(10),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ]);

    // إضافة بيانات إلى جدول password_reset_tokens
    DB::table('password_reset_tokens')->insert([
        'email' => 'john@example.com',
        'token' => Str::random(60),
        'created_at' => Carbon::now(),
    ]);

    // إضافة بيانات إلى جدول sessions
    DB::table('sessions')->insert([
        'id' => Str::random(40),
        'user_id' => 1,  
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Mozilla/5.0',
        'payload' => json_encode(['foo' => 'bar']),
        'last_activity' => time(),
    ]);
}

    
}
