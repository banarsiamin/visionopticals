<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\Admin\PrescriptionController as AdminPrescriptionController;
use App\Http\Controllers\Auth\LoginController;

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public routes
Route::get('/', [PrescriptionController::class, 'index'])->name('prescription.index');
Route::prefix('prescription')->name('prescription.')->group(function () {
    Route::post('/', [PrescriptionController::class, 'store'])->name('store');
    Route::get('/{prescription}/print', [PrescriptionController::class, 'print'])->name('print');
    Route::get('/{prescription}/whatsapp', [PrescriptionController::class, 'sendWhatsApp'])->name('whatsapp');
    Route::get('/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('edit');
    Route::put('/{prescription}', [PrescriptionController::class, 'update'])->name('update');
});

// Admin routes (protected)
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/prescriptions', [AdminPrescriptionController::class, 'index'])->name('prescriptions.index');
        Route::get('/prescriptions/{prescription}', [AdminPrescriptionController::class, 'view'])->name('prescriptions.view');
        Route::get('/prescriptions/{prescription}/edit', [AdminPrescriptionController::class, 'edit'])->name('prescriptions.edit');
        Route::put('/prescriptions/{prescription}', [AdminPrescriptionController::class, 'update'])->name('prescriptions.update');
        Route::put('/prescriptions/{prescription}/mark-as-paid', [AdminPrescriptionController::class, 'markAsPaid'])->name('prescriptions.markAsPaid');
    });
