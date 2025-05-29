<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventVettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (handled by Laravel Breeze)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Event routes
    Route::resource('events', EventController::class);
    
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Event vetting routes
        Route::get('/events/pending', [EventVettingController::class, 'index'])->name('events.pending');
        Route::get('/events/{event}/review', [EventVettingController::class, 'review'])->name('events.review');
        Route::post('/events/{event}/approve', [EventVettingController::class, 'approve'])->name('events.approve');
        Route::post('/events/{event}/reject', [EventVettingController::class, 'reject'])->name('events.reject');
    });
});
