<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');;

Route::group(['middleware' => 'auth'], function () {

    Route::resources([
        'users' => UserController::class,
        'providers' => ProviderController::class,
        'inventory/products' => ProductController::class,
        'clients' => ClientController::class,
        'inventory/categories' => ProductCategoryController::class,
        'transactions/transfer' => TransferController::class,
        'methods' => MethodController::class,
    ]);
    
    Route::resource('transactions', TransactionController::class)->except(['create', 'show']);
    Route::get('transactions/stats/{year?}/{month?}/{day?}', ['as' => 'transactions.stats', 'uses' => [TransactionController::class, 'stats']]);
    Route::get('transactions/{type}', [TransactionController::class, 'type'])->name('transactions.type');
    Route::get('transactions/{type}/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');

    Route::get('inventory/stats/{year?}/{month?}/{day?}', [InventoryController::class, 'stats'])->name('inventory.stats');
    Route::resource('inventory/receipts', ReceiptController::class)->except(['edit', 'update']);
    Route::get('inventory/receipts/{receipt}/finalize', [ReceiptController::class, 'finalize'])->name('receipts.finalize');
    Route::get('inventory/receipts/{receipt}/product/add', [ReceiptController::class, 'addproduct'])->name('receipts.product.add');
    Route::get('inventory/receipts/{receipt}/product/{receivedproduct}/edit', [ReceiptController::class, 'editproduct'])->name('receipts.product.edit');
    Route::post('inventory/receipts/{receipt}/product', [ReceiptController::class, 'storeproduct'])->name('receipts.product.store');
    Route::match(['put', 'patch'], 'inventory/receipts/{receipt}/product/{receivedproduct}', [ReceiptController::class, 'updateproduct'])->name('receipts.product.store');
    Route::delete('inventory/receipts/{receipt}/product/{receivedproduct}', [ReceiptController::class, 'destroyproduct'])->name('receipts.product.destroy');

    Route::resource('sales', SaleController::class)->except(['edit', 'update']);
    Route::get('sales/{sale}/finalize', ['as' => 'sales.finalize', 'uses' => [SaleController::class, 'finalize']]);
    Route::get('sales/{sale}/product/add', ['as' => 'sales.product.add', 'uses' => [SaleController::class,'addproduct']]);
    Route::get('sales/{sale}/product/{soldproduct}/edit', ['as' => 'sales.product.edit', 'uses' => [SaleController::class, 'editproduct']]);
    Route::post('sales/{sale}/product', ['as' => 'sales.product.store', 'uses' => [SaleController::class, 'storeproduct']]);
    Route::match(['put', 'patch'], 'sales/{sale}/product/{soldproduct}', ['as' => 'sales.product.update', 'uses' => [SaleController::class, 'updateproduct']]);
    Route::delete('sales/{sale}/product/{soldproduct}', ['as' => 'sales.product.destroy', 'uses' => [SaleController::class, 'destroyproduct']]);

    Route::get('clients/{client}/transactions/add', ['as' => 'clients.transactions.add', 'uses' => [ClientController::class,'addtransaction']]);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => [ProfileController::class, 'edit']]);
    Route::match(['put', 'patch'], 'profile', ['as' => 'profile.update', 'uses' => [ProfileController::class,'update']]);
    Route::match(['put', 'patch'], 'profile/password', ['as' => 'profile.password', 'uses' => [ProfileController::class,'password']]);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('icons', ['as' => 'pages.icons', 'uses' => [PageController::class, 'icons']]);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => [PageController::class, 'notifications']]);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => [PageController::class, 'tables']]);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => [PageController::class, 'typography']]);
});
