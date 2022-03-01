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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('role')->group(function () {
        Route::get('/view', function () {
            return Inertia::render('Teams/Roles/Index');
        })->name('teams.role.view');
    });
    Route::resource('/role', 'RoleController');

    // MENÚ
    Route::prefix('menu')->group(function () {
        Route::get('/view', function () {
            return Inertia::render('Teams/Menu/Index');
        })->name('teams.menu.view');
        Route::get('/tree', 'MenuController@menuTree');
    });
    Route::resource('/menu', 'MenuController');

    Route::resource('/user', 'UserController');
});
