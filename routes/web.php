<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\KpiLogController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CustomerAssignmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AboutController;

Route::get('/', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('branches', BranchController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('inventories/history', [InventoryController::class, 'history'])->name('inventories.history');
    Route::get('inventories/transfer', [InventoryController::class, 'transferForm'])->name('inventories.transfer.form');
    Route::post('inventories/transfer', [InventoryController::class, 'transfer'])->name('inventories.transfer');
    Route::post('inventories/{inventory}/adjust', [InventoryController::class, 'adjust'])->name('inventories.adjust');
    Route::resource('inventories', InventoryController::class);
    Route::get('sales/{sale}/pdf', [SaleController::class, 'downloadPdf'])->name('sales.pdf');
    Route::resource('sales', SaleController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('kpi-logs', KpiLogController::class);
    Route::resource('activity-logs', ActivityLogController::class);
    Route::resource('customer-assignments', CustomerAssignmentController::class);

    // Reports Module
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

    Route::get('customers/lost', [CustomerController::class, 'lost'])->name('customers.lost');
    Route::post('promotions/send', [PromotionController::class, 'send'])->name('promotions.send');

    // About ERP Route
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});

require __DIR__.'/auth.php';
