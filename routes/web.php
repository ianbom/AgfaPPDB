<?php

use App\Http\Controllers\Admin\PemberkasanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\PemberkasanController as UserPemberkasanController;
use App\Http\Controllers\User\ProfileController;
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

 Route::prefix('orangtua')->middleware([])->as('orangtua.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/orangtua-update', [ProfileController::class, 'updateOrangtua'])->name('profile.update');
    Route::put('/profile/anak-update', [ProfileController::class, 'updateAnak'])->name('anak.update');

    Route::resource('/pemberkasan', UserPemberkasanController::class);
 });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

