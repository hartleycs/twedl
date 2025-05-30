<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventVettingController;
use App\Http\Controllers\SettingsController;

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

    Route::post('/settings/appearance/update', [App\Http\Controllers\AppearanceController::class, 'update'])
    ->name('settings.appearance.update')
    ->middleware(['auth']);
    
    // Settings routes
    Route::get('/settings/profile', [SettingsController::class, 'profile'])->name('settings.profile');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    
    // Event routes
    Route::resource('events', EventController::class);
    
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Event vetting routes
        Route::get('/events/pending', [EventVettingController::class, 'index'])->name('events.pending');
        Route::get('/events/{event}/review', [EventVettingController::class, 'review'])->name('events.review');
        Route::post('/events/{event}/approve', [EventVettingController::class, 'approve'])->name('events.approve');
        Route::post('/events/{event}/reject', [EventVettingController::class, 'reject'])->name('events.reject');
        
        // Tag management routes
        Route::get('/tags', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('tags.index');
        Route::post('/tags/{tag}/approve', [App\Http\Controllers\Admin\TagController::class, 'approve'])->name('tags.approve');
        Route::post('/tags/{tag}/reject', [App\Http\Controllers\Admin\TagController::class, 'reject'])->name('tags.reject');
        Route::post('/tags/bulk', [App\Http\Controllers\Admin\TagController::class, 'bulk'])->name('tags.bulk');
        
        // Event type management routes
        Route::resource('event-types', App\Http\Controllers\Admin\EventTypeController::class);
        
        // Event sub-type management routes
        Route::get('/event-types/{eventType}/sub-types', [App\Http\Controllers\Admin\EventSubTypeController::class, 'index'])->name('event-types.sub-types.index');
        Route::get('/event-types/{eventType}/sub-types/create', [App\Http\Controllers\Admin\EventSubTypeController::class, 'create'])->name('event-types.sub-types.create');
        Route::post('/event-types/{eventType}/sub-types', [App\Http\Controllers\Admin\EventSubTypeController::class, 'store'])->name('event-types.sub-types.store');
        Route::get('/sub-types/{subType}/edit', [App\Http\Controllers\Admin\EventSubTypeController::class, 'edit'])->name('sub-types.edit');
        Route::put('/sub-types/{subType}', [App\Http\Controllers\Admin\EventSubTypeController::class, 'update'])->name('sub-types.update');
        Route::delete('/sub-types/{subType}', [App\Http\Controllers\Admin\EventSubTypeController::class, 'destroy'])->name('sub-types.destroy');
    });
});
