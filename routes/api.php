<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\TransactionController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    // Public API Check
    Route::get('/status', function() {
        return response()->json(['status' => 'online', 'version' => '1.0.0']);
    });

    // Authenticated API Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('sales', SaleController::class)->only(['index', 'store', 'show']);
        Route::apiResource('branches', BranchController::class);
        
        Route::get('inventories', [InventoryController::class, 'index']);
        Route::post('inventories/transfer', [InventoryController::class, 'transfer']);
        Route::apiResource('transactions', TransactionController::class)->only(['index', 'store', 'show']);
    });
});
