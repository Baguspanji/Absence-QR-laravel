<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
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
    Route::get('events/{event}/export', [\App\Http\Controllers\EventController::class, 'exportAttendees'])
        ->name('events.export');
    Route::get('events/{event}/clone', [\App\Http\Controllers\EventController::class, 'showCloneForm'])
        ->name('events.clone.form');
    Route::post('events/{event}/clone', [\App\Http\Controllers\EventController::class, 'cloneEvent'])
        ->name('events.clone');

    // Feedback routes
    Route::resource('feedback', \App\Http\Controllers\FeedbackController::class);
    Route::get('feedback/{feedback}/qr-code', [\App\Http\Controllers\FeedbackController::class, 'showQrCode'])
        ->name('feedback.qrcode');
    Route::post('feedback/{feedback}/toggle-active', [\App\Http\Controllers\FeedbackController::class, 'toggleActive'])
        ->name('feedback.toggle-active');

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

// Public feedback routes (no authentication required)
Route::get('public-feedback/{token}', [\App\Http\Controllers\FeedbackResponseController::class, 'show'])
    ->name('feedback.public');
Route::post('public-feedback/{token}', [\App\Http\Controllers\FeedbackResponseController::class, 'store'])
    ->name('feedback.submit');

require __DIR__ . '/auth.php';
