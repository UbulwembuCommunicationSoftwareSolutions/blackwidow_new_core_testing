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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', 'App\Http\Controllers\AdminPanelController@index')->name('admin.panel');
});


Route::resource('user', App\Http\Controllers\UserController::class)->middleware(['auth', 'verified']);
Route::resource('person', App\Http\Controllers\PersonController::class)->middleware(['auth', 'verified']);
Route::resource('department', App\Http\Controllers\DepartmentController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
