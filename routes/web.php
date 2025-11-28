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
Route::middleware(['auth', 'is_admin'])->prefix('contacts')->name('contacts.')
    ->group(function () {
        Route::resource('/', ContactController::class)->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ])->parameters(['' => 'contact']);
    });


// Optional: admin route to view ALL contacts across system
Route::middleware(['auth', 'is_admin'])->get('/admin/contacts-all', [ContactController::class, 'allContacts'])->name('admin.contacts.all');

require __DIR__.'/auth.php';
