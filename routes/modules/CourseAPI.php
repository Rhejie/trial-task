<?php

use Domain\Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::resource('course', CourseController::class);

Route::prefix('course')
    ->controller(CourseController::class)
    ->group(function () {
        Route::post('enroll-student', 'enrollStudent');
    });
