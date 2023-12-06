<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// any can visit
Auth::routes();
Route::get('/', [ThreadsController::class, 'index'])->name('home');
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.profile');
Route::get('/thread/{id}', [ThreadsController::class, 'show'])->name('thread.show');

// must be logged in
Route::post('/thread/{post}/reply', [ReplyController::class, 'store'])->name('reply.store')->middleware('auth');

// must be logged in as admin
Route::group(['middleware' => ['IsAdmin', 'auth']], function () {
    Route::get('/thread/new', [ThreadsController::class, 'create'])->name('thread.create');
    Route::post('/thread/store', [ThreadsController::class, 'store'])->name('thread.store');
});