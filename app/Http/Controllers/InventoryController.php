<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::with(["product", "branch"]);

        // Simple low stock filter
        if ($request->has('low_stock')) {
            $query->where('quantity', '<', 10);
        }

        $inventories = $query->orderBy('quantity', 'asc')->paginate(10);
        return view("inventories.index", compact("inventories"));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        return view("inventories.create", compact("products", "branches"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "product_id" => "required|exists:products,id",
            "branch_id" => "required|exists:branches,id",
            "quantity" => "required|integer|min:0",
        ]);

        DB::beginTransaction();
        try {
            // Check if already exists in that branch
            $inventory = Inventory::where('product_id', $validated['product_id'])
                                  ->where('branch_id', $validated['branch_id'])
                                  ->first();

            if ($inventory) {
                $inventory->increment('quantity', $validated['quantity']);
            } else {
                $inventory = Inventory::create($validated);
            }

            // Log the Stock In
            InventoryLog::create([
                "inventory_id" => $inventory->id,
                "type" => "Stock In",
                "quantity" => $validated["quantity"],
                "description" => "Initial stock placement / Stock In"
            ]);

            DB::commit();
            return redirect()->route("inventories.index")->with("success", "Inventory created & logged successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function adjust(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'type' => 'required|in:Stock In,Stock Out',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            $quantity = $validated['quantity'];

            if ($validated['type'] === 'Stock Out') {
                if ($inventory->quantity < $quantity) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Insufficient stock. Available: ' . $inventory->quantity
                    ]);
                }
                $inventory->decrement('quantity', $quantity);
            } else {
                $inventory->increment('quantity', $quantity);
            }

            InventoryLog::create([
                'inventory_id' => $inventory->id,
                'type' => $validated['type'],
                'quantity' => $quantity,
                'description' => $validated['description'] ?? "Manual Stock Adjustment"
            ]);

            DB::commit();
            return redirect()->route('inventories.index')->with('success', 'Inventory adjusted and logged successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function transferForm()
    {
        $products = Product::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        return view('inventories.transfer', compact('products', 'branches'));
    }

    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'from_branch_id' => 'required|exists:branches,id|different:to_branch_id',
            'to_branch_id' => 'required|exists:branches,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            // Find inventory in source branch
            $sourceInv = Inventory::where('product_id', $validated['product_id'])
                                  ->where('branch_id', $validated['from_branch_id'])
                                  ->first();

            if (!$sourceInv || $sourceInv->quantity < $validated['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Insufficient stock in source branch. Available: ' . ($sourceInv ? $sourceInv->quantity : 0)
                ]);
            }

            // Find or create inventory in destination branch
            $destInv = Inventory::firstOrCreate(
                [
                    'product_id' => $validated['product_id'],
                    'branch_id' => $validated['to_branch_id']
                ],
                ['quantity' => 0]
            );

            // Deduct and add
            $sourceInv->decrement('quantity', $validated['quantity']);
            $destInv->increment('quantity', $validated['quantity']);

            // Logs
            InventoryLog::create([
                'inventory_id' => $sourceInv->id,
                'type' => 'Stock Out',
                'quantity' => $validated['quantity'],
                'description' => "Transferred to branch: " . $destInv->branch->name . ". " . ($validated['description'] ?? '')
            ]);

            InventoryLog::create([
                'inventory_id' => $destInv->id,
                'type' => 'Stock In',
                'quantity' => $validated['quantity'],
                'description' => "Transferred from branch: " . $sourceInv->branch->name . ". " . ($validated['description'] ?? '')
            ]);

            DB::commit();
            return redirect()->route('inventories.index')->with('success', 'Stock transferred between branches successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function history()
    {
        $logs = InventoryLog::with(['inventory.product', 'inventory.branch'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);
        return view('inventories.history', compact('logs'));
    }

    public function show(Inventory $inventory)
    {
        $inventory->load(['product', 'branch', 'logs' => function($q) {
            $q->orderBy('created_at', 'desc');
        }]);
        return view("inventories.show", compact("inventory"));
    }

    public function edit(Inventory $inventory)
    {
        $products = Product::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        return view("inventories.edit", compact("inventory", "products", "branches"));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            "product_id" => "required|exists:products,id",
            "branch_id" => "required|exists:branches,id",
            "quantity" => "required|integer|min:0",
        ]);

        DB::beginTransaction();
        try {
            $difference = $validated['quantity'] - $inventory->quantity;

            $inventory->update($validated);

            if ($difference !== 0) {
                InventoryLog::create([
                    'inventory_id' => $inventory->id,
                    'type' => $difference > 0 ? 'Stock In' : 'Stock Out',
                    'quantity' => abs($difference),
                    'description' => 'Manual Edit Adjustment'
                ]);
            }

            DB::commit();
            return redirect()->route("inventories.index")->with("success", "Inventory updated successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroy(Inventory $inventory)
    {
        DB::beginTransaction();
        try {
            // Delete logs first
            InventoryLog::where('inventory_id', $inventory->id)->delete();
            $inventory->delete();

            DB::commit();
            return redirect()->route("inventories.index")->with("success", "Inventory deleted successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
