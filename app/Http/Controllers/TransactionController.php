<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\Sale;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with("sale.customer")->paginate(10);
        return view("transactions.index", compact("transactions"));
    }

    public function create()
    {
        $sales = Sale::with("customer")->get();
        return view("transactions.create", compact("sales"));
    }

    public function store(StoreTransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect()->route("transactions.index")->with("success", "Transaction recorded successfully.");
    }

    public function show(Transaction $transaction)
    {
        $transaction->load("sale.customer");
        return view("transactions.show", compact("transaction"));
    }

    public function edit(Transaction $transaction)
    {
        abort(404, "Editing completed transactions is not allowed.");
    }

    public function update(Request $request, Transaction $transaction)
    {
        abort(404, "Updating completed transactions is not allowed.");
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route("transactions.index")->with("success", "Transaction deleted successfully.");
    }
}
