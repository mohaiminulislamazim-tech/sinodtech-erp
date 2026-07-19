<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Return full transaction list with associated sales
        $transactions = Transaction::with('sale.customer')->get();
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::with('sale.customer')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }
}
