<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        // Return full inventory with product and branch associations
        $inventories = Inventory::with(['product', 'branch'])->get();
        return response()->json([
            'success' => true,
            'data' => $inventories
        ]);
    }

    public function show($id)
    {
        $inventory = Inventory::with(['product', 'branch', 'logs'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $inventory
        ]);
    }
}
