<?php

use App\Http\Controllers\Administrator\GroupController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Administrator\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;

Route::get('lang/{locale}', [LocaleController::class, 'changeLocale'])->name('lang.switch');

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
        return redirect()->route('homepages.index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/homepages', function () {
            return view('homepages.index');
        })->name('homepages.index');
    Route::resource('courses', CourseController::class);
    Route::resource('users', UserController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('lessons', LessonController::class);
    Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profiles.index');

       
});


