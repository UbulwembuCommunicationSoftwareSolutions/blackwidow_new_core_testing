<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', 'App\Http\Controllers\HomeController@showDashBoard')->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', 'App\Http\Controllers\AdminPanelController@index')->name('admin.panel');
});

Route::post('/profile_picture/person', 'App\Http\Controllers\PersonController@updateProfilePicture');
Route::post('/profile_picture/user', 'App\Http\Controllers\UserController@updateProfilePicture');
Route::resource('user', App\Http\Controllers\UserController::class)->middleware(['auth', 'verified']);
Route::resource('person', App\Http\Controllers\PersonController::class)->middleware(['auth', 'verified']);
Route::resource('department', App\Http\Controllers\DepartmentController::class)->middleware(['auth', 'verified']);
Route::resource('incident', App\Http\Controllers\IncidentController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
