<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Setup the Course API routes and set the route parameter as 'id'
    Route::apiResource(
        'courses', 
        \App\Http\Controllers\Api\V1\CourseApiController::class
    )->parameters([
        'courses' => 'id',
    ]);
});
