<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::middleware(['auth:web', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::middleware(['can:user-access'])->group(function () {
        Route::get('/permission', function () {
            return view('admin.permissions');
        })->name('permission');

        Route::get('/role', function () {
            return view('admin.roles');
        })->name('role');

        Route::get('/user', function () {
            return view('admin.users');
        })->name('user');

        Route::get('/layout', function () {
            return view('/admin.layouts');
        })->name('layout');

        Route::get('/page-management', function () {
            return view('/admin.pages');
        })->name('page-management');
    });

});

//Route Hooks - Do not delete//
	Route::view('posts', 'livewire.posts.index')->middleware('auth');