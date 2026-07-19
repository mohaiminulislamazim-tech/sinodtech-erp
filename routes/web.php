<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');

// Authenticated Web Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modules
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('customers', CustomerController::class);
    Route::get('customers/lost', [CustomerController::class, 'lost'])->name('customers.lost');
    Route::resource('employees', EmployeeController::class);
    Route::resource('branches', BranchController::class);
    
    // Sales & POS
    Route::resource('sales', SaleController::class)->except(['edit', 'update']);
    Route::get('sales/{sale}/pdf', [SaleController::class, 'downloadPdf'])->name('sales.pdf');
    
    // Inventory
    Route::get('inventories/history', [InventoryController::class, 'history'])->name('inventories.history');
    Route::get('inventories/transfer', [InventoryController::class, 'transferForm'])->name('inventories.transfer.form');
    Route::post('inventories/transfer', [InventoryController::class, 'transfer'])->name('inventories.transfer');
    Route::post('inventories/{inventory}/adjust', [InventoryController::class, 'adjust'])->name('inventories.adjust');
    Route::resource('inventories', InventoryController::class);

    // Transactions & Reports
    Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');

    // CRM / Promotions
    Route::post('promotions/send', [PromotionController::class, 'send'])->name('promotions.send');
    Route::resource('promotions', PromotionController::class);

    // Logs
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
