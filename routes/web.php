<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\ColocationController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\MembershipController;
use App\Http\Controllers\User\DebtController;
use App\Http\Controllers\User\InvitationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'statistiques'])->name('admin.dashboard');
    Route::post('/users/{user}/toggle-ban', [AdminController::class, 'toggleBan'])->name('users.toggleBan');
});

Route::middleware('auth')->group(function () {

    // colocations routes
    Route::resource('colocations', ColocationController::class);
    Route::post('/colocations/{colocation}/transfer/{user}', [ColocationController::class, 'transferOwnership'])->name('colocations.transfer');
   
    // expenses routes
    Route::resource('colocations.expenses', ExpenseController::class)->shallow();

    // categories routes
    Route::resource('colocations.categories', CategoryController::class)->shallow();

    // debts routes
    Route::get('/colocations/{colocation}/debts', [DebtController::class, 'index'])->name('debts.index');

    // payment routes
    Route::post('/payments/mark-paid', [PaymentController::class, 'markAsPaid'])->name('payments.markAsPaid');

    // memberships routes
    Route::post('/memberships/{membership}/leave', [MembershipController::class, 'leave'])->name('memberships.leave');
    Route::delete('/colocations/{colocation}/kick/{user}', [MembershipController::class, 'kick'])->name('memberships.kick');

    // invitations routes
    Route::post('/colocations/{colocation}/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{token}', [InvitationController::class, 'show'])->name('invitations.show');
    Route::post('/invitations/{token}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');
    Route::post('/invitations/{token}/refuse', [InvitationController::class, 'refuse'])->name('invitations.refuse');
});

require __DIR__.'/auth.php';