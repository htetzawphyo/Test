<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;

Route::group(['middleware' => 'AuthCheck'], function() {
    Route::controller(RolesController::class)->group(function() {
        Route::get('/roles', 'index')->name('roles');
        Route::post('/roles/store', 'store')->name('roles.store');
        Route::get('/roles/{role}', 'edit')->name('roles.edit');
        Route::put('/roles/{role}', 'update')->name('roles.update');
        Route::delete('/roles/{role}', 'delete')->name('roles.delete');
    });
    
    Route::controller(UsersController::class)->group(function() {
        Route::get('/users', 'index')->name('users');
        Route::post('/users/store', 'store')->name('users.store');
        Route::get('/users/add', 'add')->name('users.add');
        Route::get('/users/{user}', 'edit')->name('users.edit');
        Route::put('/users/{user}', 'update')->name('users.update');
        Route::delete('/users/{user}', 'delete')->name('users.delete');
    });
    Route::get('/home', [App\Http\Controllers\UsersController::class, 'index'])->name('home');
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {    
    return view('auth.login'); 
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/check', [App\Http\Controllers\AuthController::class, 'check'])->name('check');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Auth::routes();

