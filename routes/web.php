<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\AuthorizeMiddleware;

/**
 * Приветствие
 */
Route::get('/', fn() => inertia('Page/Home'))->middleware('auth');

/**
 * Пользователи
 */
Route::get('/login/', [UserController::class, 'login'])->name('login');
Route::post('/login/', [UserController::class, 'loginPost']);
Route::middleware('auth')->group(function () {
    Route::post('/logout/', [UserController::class, 'logout']);
    Route::resource('users', UserController::class)->scoped(['user' => 'username']);
})->where(['user' => '[a-zA-Z0-9]+']);

Route::post('projects', [ProjectController::class, 'store'])->name('projects.store')->withoutMiddleware([AuthorizeMiddleware::class]);
Route::put('projects/{id}', [ProjectController::class, 'update'])->name('projects.update')->withoutMiddleware([AuthorizeMiddleware::class]);
Route::resource('projects', ProjectController::class);

