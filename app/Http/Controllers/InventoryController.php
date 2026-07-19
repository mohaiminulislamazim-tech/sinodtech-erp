<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Branch;
use App\Models\InventoryLog;
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
        $query = Inventory::with(['product', 'branch']);

        if ($request->has('search')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('branch', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $inventories = $query->latest()->paginate(15);
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        $branches = Branch::all();
        return view('inventories.create', compact('products', 'branches'));
    }

    public function store(StoreInventoryRequest $request)
    {
        Inventory::create($request->validated());
        return redirect()->route('inventories.index')->with('success', 'Inventory record created.');
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        return redirect()->route('inventories.index')->with('success', 'Inventory updated.');
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
            return redirect()->route('inventories.index')->with('success', 'Stock transferred successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function adjust(Request $request, Inventory $inventory)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ]);

        $this->inventoryService->adjustStock($inventory->id, $request->quantity, $request->reason);
        return back()->with('success', 'Inventory adjusted.');
    }

    public function history()
    {
        $logs = InventoryLog::with(['product', 'branch', 'user'])->latest()->paginate(20);
        return view('inventories.history', compact('logs'));
    }
}
