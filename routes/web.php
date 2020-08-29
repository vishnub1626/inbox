<?php

use App\Http\Controllers\AvatarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboxController;

Route::get('/', [InboxController::class, 'index'])->name('home');
Route::get('/messages/{message}', [InboxController::class, 'find']);
Route::delete('/messages/{message}', [InboxController::class, 'destroy']);

Route::get('/avatar', AvatarController::class);
