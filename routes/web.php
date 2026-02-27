<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\IsAdmin;
use App\Models\Payment;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard', [AdminController::class, 'statistiques'])
     ->name('admin.dashboard')
     ->middleware(['auth','admin']);

Route::post('/users/{user}/toggle-ban', [AdminController::class, 'toggleBan'])
     ->name('users.toggleBan')
     ->middleware(['auth', 'admin']); 



Route::resource('expenses', ExpenseController::class)->middleware('auth');

Route::resource('colocations', ColocationController::class)->middleware('auth');

Route::resource('payments', PaymentController::class)->middleware('auth');

require __DIR__.'/auth.php';
