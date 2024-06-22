<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductCategoryController;

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

Route::get('/', fn () => redirect()->route('login'));

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/category/data', [ProductCategoryController::class, 'data'])->name('category.data');
    Route::resource('/category', ProductCategoryController::class);
    Route::get('/products/data', [ProductsController::class, 'data'])->name('products.data');
    Route::post('/products/delete-selected', [ProductsController::class, 'deleteSelected'])->name('products.delete_selected');
    Route::post('/products/cetak-barcode', [ProductsController::class, 'cetakBarcode'])->name('products.cetak_barcode');
    Route::resource('/products', ProductsController::class);
    Route::get('/member/data', [MembersController::class, 'data'])->name('member.data');
    Route::post('/member/cetak-member', [MembersController::class, 'cetakMember'])->name('member.cetak_member');
    Route::resource('/member', MembersController::class);
    Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('/supplier', SupplierController::class);
});


Route::prefix('cashier')->group(function () {
    // Route::get('/', fn()=> redirect()->route('/dashboard'));
    Route::get('/dashboard', fn () => view('cashier.dashboard'))->middleware(['auth', 'verified'])->name('cashier.dashboard');
    // Route::get('/sales', [CashierController::class, 'sales'])->name('cashier.sales');
    // Route::get('/transactions', [CashierController::class, 'transactions'])->name('cashier.transactions');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
