<?php

use App\Http\Controllers\Administrator\GroupController;
use App\Http\Controllers\Administrator\GroupStudentsController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/', function () {
        return redirect()->route('login');
    });
});


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('users.index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('courses', CourseController::class);
    Route::resource('users', UserController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('profiles', UserController::class);
    Route::get('group-student', GroupStudentsController::class);
});
