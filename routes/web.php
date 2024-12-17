<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\InboxController;

/**
 * Route untuk Halaman Utama
 */
Route::get('/', [PageController::class, 'index'])->name('index');

/**
 * Route untuk Login dan Registrasi
 */
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'loginProcess'])->name('loginProcess');

// Registrasi pengguna
Route::get('/create-account', [PageController::class, 'createAccount'])->name('createAccount');
Route::post('/create-account', [PageController::class, 'registerAccount'])->name('registerAccount');

/**
 * Route untuk Pengaturan Akun
 */
Route::get('/account-settings', [PageController::class, 'accountSettings'])->name('accountSettings');
Route::post('/account-settings', [PageController::class, 'updateAccountSettings'])->name('updateAccountSettings');
Route::post('/change-password', [PageController::class, 'changePassword'])->name('changePassword');

/**
 * Route untuk Halaman Tambahan
 */
Route::get('/order-history', [PageController::class, 'orderHistory'])->name('orderHistory');
Route::get('/top-up/{game}', [PageController::class, 'topUp'])->name('topUp');

/**
 * Route untuk Game Management
 * Digunakan oleh admin untuk menambah dan menghapus game
 */
Route::post('/games/store', [GameController::class, 'store'])->name('games.store');

// Route untuk game berdasarkan nama atau ID
Route::get('/game/{game}', [PageController::class, 'gamePage'])->name('gamePage');

/**
 * Route untuk Admin Dashboard
 */
Route::get('/admin-dashboard', [PageController::class, 'adminDashboard'])->name('adminDashboard');

// Route untuk halaman game
Route::get('/games/{slug}', [GameController::class, 'show'])->name('games.show');
Route::delete('/games/delete/{id}', [GameController::class, 'deletegame'])->name('games.delete');

// Route untuk menyimpan konfirmasi pembelian (user mengunggah bukti pembayaran)
Route::post('/inbox/store', [InboxController::class, 'store'])->name('inbox.store');
Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::post('/inbox/store', [InboxController::class, 'store'])->name('inbox.store');
    Route::patch('/inbox/approve/{payment}', [InboxController::class, 'approve'])->name('inbox.approve');
    Route::patch('/inbox/reject/{payment}', [InboxController::class, 'rejectPayment'])->name('inbox.reject');
    Route::post('/inbox/redeem/{payment}', [InboxController::class, 'redeem'])->name('inbox.redeem');
});

// Route untuk halaman edit game
Route::get('/game/{game}/edit', [GameController::class, 'edit'])->name('game.edit');
Route::post('/game/{game}/update', [GameController::class, 'update'])->name('game.update');

// Route untuk menambah paket dan metode pembayaran
Route::post('/game/{game_id}/add-package', [GameController::class, 'addGamePackage'])->name('game.addPackage');
Route::post('/game/{game}/add-payment-method', [GameController::class, 'addPaymentMethod'])->name('game.addPaymentMethod');

// Route untuk menghapus paket dan metode pembayaran
Route::delete('/game/{game}/delete-package/{package}', [GameController::class, 'deletePackage'])->name('game.deletePackage');
Route::delete('/game/{game}/delete-payment-method/{paymentMethod}', [GameController::class, 'deletePaymentMethod'])->name('game.deletePaymentMethod');