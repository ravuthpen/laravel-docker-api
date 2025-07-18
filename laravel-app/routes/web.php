<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCon;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TransitionController;
use App\Http\Controllers\BankTranController;

// Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

