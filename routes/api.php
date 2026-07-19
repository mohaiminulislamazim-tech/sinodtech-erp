<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API routes grouped under prefix 'v1' and name 'api.v1.' to avoid conflicts
Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('products', Api\ProductController::class);
    Route::apiResource('customers', Api\CustomerController::class);
    Route::apiResource('sales', Api\SaleController::class);
    Route::apiResource('inventories', Api\InventoryController::class);
    Route::apiResource('transactions', Api\TransactionController::class);
});
