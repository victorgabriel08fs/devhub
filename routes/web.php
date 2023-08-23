<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        if (auth()->user()->hasRole('Super Admin'))
            return redirect()->route('admin.project.index');
        return redirect()->route('user.projects', ['username' => auth()->user()->username]);
    })->name('home');
    Route::resource('project', ProjectController::class)->except('index');
    Route::get('{username}/projects', [ProjectController::class, 'projects'])->name('user.projects');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('project', AdminProjectController::class);
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
    });
});
Auth::routes();
