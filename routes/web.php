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
Route::post('/donation/submit-payment', [PublicController::class, 'submitPayment'])->name('donation.submit-payment');

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
    Route::get('/district-members', [MemberController::class, 'districtMembers'])->name('district-members');
    Route::get('/donations/{donation}/receipt', [MemberController::class, 'downloadReceipt'])->name('donations.receipt');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Member Management
    Route::get('/members', [AdminController::class, 'members'])->name('members.index');
    Route::get('/members/export', [AdminController::class, 'membersExport'])->name('members.export');
    Route::get('/members/{member}', [AdminController::class, 'memberShow'])->name('members.show');
    Route::get('/members/{member}/id-card', [AdminController::class, 'downloadIdCard'])->name('members.id-card');
    Route::get('/members/{member}/joining-letter', [AdminController::class, 'downloadJoiningLetter'])->name('members.joining-letter');
    Route::post('/members/{member}/approve', [AdminController::class, 'approveMember'])->name('members.approve');
    Route::post('/members/{member}/reject', [AdminController::class, 'rejectMember'])->name('members.reject');
    
    // Donation Management
    Route::get('/donations', [AdminController::class, 'donations'])->name('donations.index');
    Route::get('/donations/export', [AdminController::class, 'donationsExport'])->name('donations.export');
    Route::post('/donations/{donation}/approve', [AdminController::class, 'approveDonation'])->name('donations.approve');
    Route::get('/donations/{donation}/receipt', [AdminController::class, 'downloadReceipt'])->name('donations.receipt');
    
    // Content Management
    Route::get('/sliders', [AdminController::class, 'slidersIndex'])->name('sliders.index');
    Route::post('/sliders', [AdminController::class, 'slidersStore'])->name('sliders.store');
    Route::delete('/sliders/{slider}', [AdminController::class, 'slidersDestroy'])->name('sliders.destroy');
    Route::get('/events', [AdminController::class, 'eventsIndex'])->name('events.index');
    Route::get('/events/create', [AdminController::class, 'eventsCreate'])->name('events.create');
    Route::post('/events', [AdminController::class, 'eventsStore'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminController::class, 'eventsEdit'])->name('events.edit');
    Route::post('/events/{event}', [AdminController::class, 'eventsUpdate'])->name('events.update');
    Route::delete('/events/{event}', [AdminController::class, 'eventsDestroy'])->name('events.destroy');

    // Gallery Management
    Route::get('/gallery', [AdminController::class, 'galleryIndex'])->name('gallery.index');
    Route::post('/gallery/album', [AdminController::class, 'galleryStoreAlbum'])->name('gallery.album.store');
    Route::post('/gallery/media', [AdminController::class, 'galleryStoreMedia'])->name('gallery.media.store');
    Route::delete('/gallery/album/{album}', [AdminController::class, 'galleryDestroyAlbum'])->name('gallery.album.destroy');
    Route::delete('/gallery/media/{media}', [AdminController::class, 'galleryDestroyMedia'])->name('gallery.media.destroy');
    
    // Designations
    Route::get('/designations', [AdminController::class, 'designationsIndex'])->name('designations.index');
    Route::post('/designations', [AdminController::class, 'designationsStore'])->name('designations.store');
    Route::delete('/designations/{designation}', [AdminController::class, 'designationsDestroy'])->name('designations.destroy');
    
    // Team Management
    Route::get('/team', [AdminController::class, 'teamIndex'])->name('team.index');
    Route::post('/team', [AdminController::class, 'teamStore'])->name('team.store');
    Route::delete('/team/{team}', [AdminController::class, 'teamDestroy'])->name('team.destroy');
    
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
