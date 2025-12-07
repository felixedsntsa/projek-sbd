<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

// LANDING PAGE
Route::get('/', [LandingController::class, 'index'])->name('landing');

// LOGIN & AUTHENTICATION ROUTES
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// LOGOUT ROUTE
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// PROFILE
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');

// FILTER
Route::get('/filter-umkm', [DashboardController::class, 'filterUmkm'])->name('filter.umkm');

// SEARCH
Route::get('/search', [DashboardController::class, 'search'])->name('search');
