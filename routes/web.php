<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SparkController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [SparkController::class, 'index'])->name('home');
Route::post('/sparks', [SparkController::class, 'store'])->name('sparks.store');
Route::post('/sparks/{spark}/toggle', [SparkController::class, 'toggleReaction'])->name('sparks.toggle');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Spark management (edit/delete)
    Route::put('/sparks/{spark}', [SparkController::class, 'update'])->name('sparks.update');
    Route::delete('/sparks/{spark}', [SparkController::class, 'destroy'])->name('sparks.destroy');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
