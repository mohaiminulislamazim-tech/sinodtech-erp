<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Http\Resources\SaleResource;
use App\Services\SaleService;
use App\Http\Requests\StoreSaleRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(
        protected SaleService $saleService
    ) {}

    public function index()
    {
        $sales = Sale::with(['customer', 'items.product'])->latest()->paginate(20);
        return SaleResource::collection($sales);
    }

    public function store(StoreSaleRequest $request)
    {
        try {
            $sale = $this->saleService->processSale($request->validated());
            return new SaleResource($sale->load('customer', 'items.product'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function show(Sale $sale)
    {
        return new SaleResource($sale->load(['customer', 'items.product', 'branch']));
    }
}
