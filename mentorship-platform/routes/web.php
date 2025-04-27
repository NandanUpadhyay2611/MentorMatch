<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorshipRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\VideoCallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// After login/registration, redirect based on role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'mentor') {
        return redirect()->route('mentor.dashboard');
    }
    return redirect()->route('startup.dashboard');
})->middleware(['auth'])->name('dashboard');

// Auth routes
Route::middleware(['auth'])->group(function () {
    // Common routes for both roles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Startup routes
    Route::prefix('startup')->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':startup'])->group(function () {
        Route::get('/dashboard', function () {
            return view('startup.dashboard');
        })->name('startup.dashboard');
    });

    // Mentor routes
    Route::prefix('mentor')->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':mentor'])->group(function () {
        Route::get('/dashboard', function () {
            return view('mentor.dashboard');
        })->name('mentor.dashboard');
        
        // Tag management (mentor only)
        Route::resource('tags', TagController::class);
    });

    // Shared features
    Route::get('/mentors', [MentorController::class, 'index'])->name('mentors.index');
    Route::get('/mentors/{mentor}', [MentorController::class, 'show'])->name('mentors.show');

    // Mentorship requests
    Route::resource('mentorship-requests', MentorshipRequestController::class)->except(['edit', 'destroy']);
    Route::post('mentorship-requests/{mentorshipRequest}/update-status', [MentorshipRequestController::class, 'update'])
        ->name('mentorship-requests.update-status');

    // Messages
    Route::get('mentorship-requests/{mentorshipRequest}/messages', [MessageController::class, 'index'])
        ->name('messages.index');
    Route::post('mentorship-requests/{mentorshipRequest}/messages', [MessageController::class, 'store'])
        ->name('messages.store');

    // Video calls
    Route::get('/video-call/{mentorshipRequest}', [VideoCallController::class, 'index'])->name('video-call.index');
    Route::post('/video-call/signal', [VideoCallController::class, 'signal'])->name('video-call.signal');
});

require __DIR__.'/auth.php';
