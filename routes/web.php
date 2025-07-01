<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Event routes
    Route::resource('events', \App\Http\Controllers\EventController::class);
    Route::get('events/{event}/qr-code', [\App\Http\Controllers\EventController::class, 'showQrCode'])
        ->name('events.qrcode');

    // Attendee routes
    Route::get('events/{event}/attendees/create', [\App\Http\Controllers\AttendeeController::class, 'create'])
        ->name('attendees.create');
    Route::post('events/{event}/attendees', [\App\Http\Controllers\AttendeeController::class, 'store'])
        ->name('attendees.store');
    Route::post('events/{event}/attendees/import', [\App\Http\Controllers\AttendeeController::class, 'import'])
        ->name('attendees.import');
    Route::get('attendees/template/download', [\App\Http\Controllers\AttendeeController::class, 'downloadTemplate'])
        ->name('attendees.template.download');
    Route::delete('events/{event}/attendees/{attendee}', [\App\Http\Controllers\AttendeeController::class, 'destroy'])
        ->name('attendees.destroy');
});

// Public attendance routes (no authentication required)
Route::get('attend/{token}', [\App\Http\Controllers\AttendanceController::class, 'show'])
    ->name('attendance.show');
Route::post('attend/{token}', [\App\Http\Controllers\AttendanceController::class, 'markPresent'])
    ->name('attendance.mark-present');
Route::get('attend/{token}/confirmation/{attendee}', [\App\Http\Controllers\AttendanceController::class, 'confirmation'])
    ->name('attendance.confirmation');

require __DIR__ . '/auth.php';
