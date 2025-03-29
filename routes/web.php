<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController; // Import Controller
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Publicly accessible index route
Route::get('/', [PublicationController::class, 'index'])->name('publications.index');
// Optional: Publicly accessible show route (if you implement it)
// Route::get('/publications/{publication}', [PublicationController::class, 'show'])->name('publications.show');


Route::middleware('auth')->group(function () {
    // Routes requiring authentication
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard'); // Example from Breeze

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Publication routes requiring authentication and potentially authorization (handled by Policies)
    Route::resource('publications', PublicationController::class)->except(['index', 'show']);
    // This single line is equivalent to the following protected routes:
    // Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
    // Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
    // Route::get('/publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
    // Route::put('/publications/{publication}', [PublicationController::class, 'update'])->name('publications.update'); // Handles PUT
    // Route::patch('/publications/{publication}', [PublicationController::class, 'update']); // Also handles PATCH
    // Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
});

// Include the auth routes generated by Breeze (or Laravel UI)
require __DIR__.'/auth.php';
