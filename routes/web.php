<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('students/chart', [App\Http\Controllers\Admin\StudentsCrudController::class, 'chart'])
    ->name('students.chart');

