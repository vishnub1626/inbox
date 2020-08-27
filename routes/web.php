<?php

use App\Http\Controllers\AvatarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboxController;

Route::get('/', [InboxController::class, 'index']);
Route::get('/messages/{message}', [InboxController::class, 'find']);

Route::get('/avatar', AvatarController::class);
