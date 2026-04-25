<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/events', [PublicController::class, 'events'])->name('events');
Route::get('/events/{event}', [PublicController::class, 'showEvent'])->name('events.show');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/join-us', [PublicController::class, 'joinUs'])->name('join-us');
Route::post('/join-us', [PublicController::class, 'storeMember'])->name('join-us.store');
Route::get('/donation', [PublicController::class, 'donation'])->name('donation');
Route::post('/donation', [PublicController::class, 'storeDonation'])->name('donation.store');

// Dashboard Redirect
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('member.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Member Routes
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
    Route::get('/id-card', [MemberController::class, 'downloadIdCard'])->name('id-card');
    Route::get('/joining-letter', [MemberController::class, 'downloadJoiningLetter'])->name('joining-letter');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Member Management
    Route::get('/members', [AdminController::class, 'members'])->name('members.index');
    Route::post('/members/{member}/approve', [AdminController::class, 'approveMember'])->name('members.approve');
    Route::post('/members/{member}/reject', [AdminController::class, 'rejectMember'])->name('members.reject');
    
    // Content Management
    Route::resource('sliders', AdminController::class . '@sliders'); // Placeholder for proper resource logic
    Route::resource('events', AdminController::class . '@events');
    Route::resource('designations', AdminController::class . '@designations');
    
    // Settings & Documents
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/templates', [AdminController::class, 'templates'])->name('templates');
    Route::post('/templates', [AdminController::class, 'updateTemplates'])->name('templates.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
