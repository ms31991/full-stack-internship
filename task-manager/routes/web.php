<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/hello', function () {
    return 'Hello from laravel';
});

Route::get('/projects', [ProjectController::class, 'index']);