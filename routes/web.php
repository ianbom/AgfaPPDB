<?php

use App\Http\Controllers\Admin\PemberkasanController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('web.admin.dashboard.index');
});


Route::prefix('admin')->middleware([])->as('admin.')->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/pemberkasan', PemberkasanController::class);
 });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

