<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Branch;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['branch', 'sale.customer']);

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->latest()->paginate(20);
        $branches = Branch::all();

        return view('transactions.index', compact('transactions', 'branches'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('transactions.create', compact('branches'));
    }

    public function store(StoreTransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect()->route('transactions.index')->with('success', 'Transaction recorded.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['branch', 'sale.customer', 'reference']);
        return view('transactions.show', compact('transaction'));
    }
}
