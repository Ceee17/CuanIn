<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => redirect()->route('/login'));

Route::get('/admin/dashboard', function(){
    return view('layouts.admin-main');
});

Route::prefix('cashier')->group(function () {
    // Route::get('/', fn()=> redirect()->route('/dashboard'));
    Route::get('/dashboard', fn()=> view('cashier.dashboard'))->middleware(['auth', 'verified'])->name('cashier.dashboard');
    // Route::get('/sales', [CashierController::class, 'sales'])->name('cashier.sales');
    // Route::get('/transactions', [CashierController::class, 'transactions'])->name('cashier.transactions');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
