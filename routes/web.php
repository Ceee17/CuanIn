<?php

use App\Models\PurchasesDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PurchasesDetailController;

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

    Route::get('/spending/data', [SpendingController::class, 'data'])->name('spending.data');
    Route::resource('/spending', SpendingController::class);

    Route::get('/purchases/data', [PurchasesController::class, 'data'])->name('purchases.data');
    Route::get('/purchases/{id}/create', [PurchasesController::class, 'create'])->name('purchases.create');
    Route::resource('/purchases', PurchasesController::class)
        ->except('create');

    Route::get('/purchases_detail/{id}/data', [PurchasesDetailController::class, 'data'])->name('purchases_detail.data');
    Route::get('/purchases_detail/loadform/{diskon}/{total}', [PurchasesDetailController::class, 'loadForm'])->name('purchases_detail.load_form');
    Route::resource('/purchases_detail', PurchasesDetailController::class)
        ->except('create', 'show', 'edit');

    Route::get('/sales/data', [SalesController::class, 'data'])->name('sales.data');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');
    Route::delete('/sales/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');

    Route::get('/transaksi/baru', [SalesController::class, 'create'])->name('transaksi.baru');
    Route::post('/transaksi/simpan', [SalesController::class, 'store'])->name('transaksi.simpan');
    Route::get('/transaksi/selesai', [SalesController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/nota-kecil', [SalesController::class, 'notaKecil'])->name('transaksi.nota_kecil');
    Route::get('/transaksi/nota-besar', [SalesController::class, 'notaBesar'])->name('transaksi.nota_besar');

    Route::get('/transaksi/{id}/data', [SalesDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [SalesDetailController::class, 'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', SalesDetailController::class)
        ->except('create', 'show', 'edit');

    Route::get('/laporan', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/laporan/data/{awal}/{akhir}', [ReportsController::class, 'data'])->name('reports.data');
    Route::get('/laporan/pdf/{awal}/{akhir}', [ReportsController::class, 'exportPDF'])->name('reports.export_pdf');


    Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
    Route::resource('/user', UserController::class);
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
