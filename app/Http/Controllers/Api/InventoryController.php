<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request)
    {
        $inventories = Inventory::with(['product', 'branch'])
            ->when($request->branch_id, fn($q) => $q->where('branch_id', $request->branch_id))
            ->latest()
            ->paginate(20);

        return response()->json($inventories);
    }

    public function store(StoreInventoryRequest $request)
    {
        $inventory = Inventory::create($request->validated());
        return response()->json($inventory, 201);
    }

    public function show(Inventory $inventory)
    {
        return response()->json($inventory->load(['product', 'branch', 'logs']));
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        return response()->json($inventory);
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'from_branch_id' => 'required|exists:branches,id',
            'to_branch_id' => 'required|exists:branches,id|different:from_branch_id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $this->inventoryService->transferStock(
                $request->product_id,
                $request->from_branch_id,
                $request->to_branch_id,
                $request->quantity
            );
            return response()->json(['message' => 'Transfer successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
