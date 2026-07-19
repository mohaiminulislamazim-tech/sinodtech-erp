<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Transaction;
use App\Http\Requests\StoreSaleRequest;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function __construct(
        protected SaleService $saleService
    ) {}

    public function index(Request $request)
    {
        $query = Sale::with(['customer', 'branch']);

        if ($request->filled('search')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhere('id', $request->search);
        }

        $sales = $query->latest()->paginate(15);
        return view('sales.index', compact('sales'));
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'items.product', 'branch', 'transactions']);
        return view('sales.show', compact('sale'));
    }

    public function downloadPdf(Sale $sale)
    {
        $sale->load(['customer', 'items.product', 'branch']);
        $pdf = Pdf::loadView('sales.invoice_pdf', compact('sale'));
        return $pdf->download("invoice-{$sale->id}.pdf");
    }

    public function destroy(Sale $sale)
    {
        // Service should handle complex rollbacks
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted.');
    }
}
