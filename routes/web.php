<?php

use App\Http\Controllers\{ProfileController, ContactController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    //return view('dashboard');
    return redirect()->route('contacts.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// Authenticated users can view only the list
Route::middleware(['auth'])->group(function () {
    // List view — accessible to Admin and regular User
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
});


// Admin-only CRUD and admin list
Route::middleware(['auth', 'is_admin'])->prefix('contacts')->name('contacts.')->group(function () {
    // Admin can do full CRUD
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::post('/', [ContactController::class, 'store'])->name('store');
    Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('/{contact}', [ContactController::class, 'update'])->name('update');
    Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy');
});

// Optional: admin route to view ALL contacts across system
Route::middleware(['auth', 'is_admin'])->get('/admin/contacts-all', [ContactController::class, 'allContacts'])->name('admin.contacts.all');

require __DIR__.'/auth.php';
