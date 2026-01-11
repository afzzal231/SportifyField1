<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueRegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Owner\OwnerDashboardController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lapangan', [FieldController::class, 'index'])->name('fields.index');
Route::get('/lapangan/{slug}', [FieldController::class, 'show'])->name('fields.show');
Route::post('/lapangan/{field}/review', [App\Http\Controllers\ReviewController::class, 'store'])->middleware(['auth', 'verified'])->name('reviews.store');

// Venue registration (public)
// Route::get('/daftar-venue', [VenueRegistrationController::class, 'create'])->name('venue.register');
Route::get('/daftar-venue', [FieldController::class, 'create'])->name('fields.register');

// Route::post('/daftar-venue', [VenueRegistrationController::class, 'store'])->name('venue.store');
Route::post('/daftar-venue', [FieldController::class, 'store'])->name('fields.store');

// Protected routes (require login)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/booking/{booking}/cancel', [DashboardController::class, 'cancelBooking'])->name('booking.cancel');

    // Booking
    Route::get('/booking/{field}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{field}', [BookingController::class, 'store'])->name('booking.store');

    // Payment
    Route::get('/payment/{booking}', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/{booking}', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/{booking}/confirmation', [PaymentController::class, 'confirmation'])->name('payment.confirmation');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

// Owner
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
    Route::post('/owner/booking/{booking}/confirm', [OwnerDashboardController::class, 'confirm'])->name('owner.booking.confirm');
    Route::post('/owner/booking/{booking}/reject', [OwnerDashboardController::class, 'reject'])->name('owner.booking.reject');
});



require __DIR__ . '/auth.php';
