<?php

use Illuminate\Support\Facades\Route;
Route::get('students/chart', function () {
    return view('vendor.backpack.crud.students.chart');
})->name('students.chart');

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('coursefee', 'CoursefeeCrudController');
    Route::crud('teacher', 'TeacherCrudController');
    Route::crud('students', 'StudentsCrudController');
    Route::crud('classroom', 'ClassroomCrudController');
    Route::crud('course', 'CourseCrudController');
    Route::crud('library', 'LibraryCrudController');
    Route::crud('book', 'BookCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('organizer', 'OrganizerCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
