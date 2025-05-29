<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventVettingController;
use App\Http\Controllers\Admin\EventTypeController;
use App\Http\Controllers\Admin\EventSubTypeController;
use App\Http\Controllers\Admin\TagModerationController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminEventController;

Route::prefix('admin')->middleware(['auth', 'can:moderate-events'])->name('admin.')->group(function () {
    Route::get('/events/moderate', [AdminEventController::class, 'moderate'])->name('events.moderate');
    Route::post('/events/{event}/approve', [AdminEventController::class, 'approve'])->name('events.approve');
    Route::post('/events/{event}/reject', [AdminEventController::class, 'reject'])->name('events.reject');
    Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('events.show');
});

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::post('/tags/bulk', [AdminTagController::class, 'bulk'])->name('tags.bulk');
    Route::get('/tags/{tag}/approve', [AdminTagController::class, 'approve'])->name('tags.approve.view');
    Route::get('/tags/{tag}/reject', [AdminTagController::class, 'reject'])->name('tags.reject.view');
});

Route::middleware(['auth', 'can:moderate-events'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/events/moderate', [App\Http\Controllers\AdminEventController::class, 'index'])->name('events.moderate');
    Route::post('/events/{event}/approve', [App\Http\Controllers\AdminEventController::class, 'approve'])->name('events.approve');
    Route::post('/events/{event}/reject', [App\Http\Controllers\AdminEventController::class, 'reject'])->name('events.reject');
});

Route::get('/admin/events/{event}', [AdminEventController::class, 'show'])
    ->middleware(['auth', 'can:moderate-events'])
    ->name('admin.events.show');

/*
|--------------------------------------------------------------------------
| Public & Invite Routes
|--------------------------------------------------------------------------
*/

Route::get('invites/{token}', [InviteController::class, 'show'])
    ->name('invites.show');

Route::get('/', [PublicEventController::class, 'index'])->name('home');
Route::get('events', [PublicEventController::class, 'index'])
    ->name('public.events.index');

/*
|--------------------------------------------------------------------------
| Dashboard View
|--------------------------------------------------------------------------
*/

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated “My Events” & Resource Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('dashboard/events', [EventController::class, 'index'])
        ->name('events.index');

    Route::resource('events', EventController::class)
         ->except(['index', 'show']);

    Route::prefix('admin')
         ->middleware('admin')
         ->as('admin.')
         ->group(function () {
             // Event vetting
             Route::get('vetting', [EventVettingController::class, 'index'])->name('vetting.index');
             Route::post('vetting/{event}/approve', [EventVettingController::class, 'approve'])->name('vetting.approve');
             Route::post('vetting/{event}/reject', [EventVettingController::class, 'reject'])->name('vetting.reject');

             // Event types and sub-types
             Route::resource('event-types', EventTypeController::class);
             Route::resource('event-types.sub-types', EventSubTypeController::class)->shallow();

             // ✅ Tag moderation
             Route::get('tags', [TagModerationController::class, 'index'])->name('tags.index');
             Route::post('tags/{tag}/approve', [TagModerationController::class, 'approve'])->name('tags.approve');
             Route::post('tags/{tag}/reject', [TagModerationController::class, 'reject'])->name('tags.reject');
             Route::post('tags/batch-approve', [TagModerationController::class, 'batchApprove'])->name('tags.batch-approve');
             Route::post('tags/batch-reject', [TagModerationController::class, 'batchReject'])->name('tags.batch-reject');

         });

    // User profile settings
    Volt::route('settings/profile',    'settings.profile')->name('settings.profile');
    Volt::route('settings/password',   'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
