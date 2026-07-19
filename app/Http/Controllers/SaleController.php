<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function downloadPdf(Sale $sale)
    {
        $sale->load("customer", "items.product");
        $pdf = Pdf::loadView('sales.invoice_pdf', compact('sale'));
        return $pdf->download("invoice-sale-{$sale->id}.pdf");
    }

    public function index()
    {
        $sales = Sale::with("customer", "items.product")->orderBy('created_at', 'desc')->paginate(10);
        return view("sales.index", compact("sales"));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        // Load products that have active inventory records to prevent selling nonexistent products
        $products = Product::with('inventories')->orderBy('name')->get();
        return view("sales.create", compact("customers", "products"));
    }

    public function store(StoreSaleRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $subtotal = 0;
            $itemsToCreate = [];

            // 1. Hard Stock Validation & Calculation
            foreach ($validated["items"] as $item) {
                $product = Product::findOrFail($item["product_id"]);
                $totalAvailable = Inventory::where("product_id", $product->id)->sum("quantity") ?? 0;

                if ($totalAvailable < $item["quantity"]) {
                    throw ValidationException::withMessages([
                        "items" => "Insufficient stock for product: " . $product->name . " (Available: " . $totalAvailable . ")",
                    ]);
                }

                $price = $product->price;
                $subtotal += $price * $item["quantity"];

                $itemsToCreate[] = [
                    "product_id" => $product->id,
                    "quantity" => $item["quantity"],
                    "price" => $price
                ];
            }

            // 2. Validate calculations from frontend values
            $discount = floatval($validated["discount"] ?? 0);
            $tax = floatval($validated["tax"] ?? 0);
            $shipping = floatval($validated["shipping"] ?? 0);
            $calculatedTotal = $subtotal - $discount + $tax + $shipping;

            // 3. Create Sale record
            $sale = Sale::create([
                "customer_id" => $validated["customer_id"],
                "subtotal" => $subtotal,
                "discount" => $discount,
                "tax" => $tax,
                "shipping" => $shipping,
                "total_amount" => $calculatedTotal,
                "payment_method" => $validated["payment_method"],
            ]);

            // 4. Create Sale Items and deduct inventory branch-wise
            foreach ($itemsToCreate as $itemData) {
                $sale->items()->create([
                    "product_id" => $itemData["product_id"],
                    "quantity" => $itemData["quantity"],
                    "price" => $itemData["price"],
                ]);

                // Deduct stock sequentially from branch-wise records with lock
                $remainingDeduction = $itemData["quantity"];
                $inventories = Inventory::where("product_id", $itemData["product_id"])
                    ->where("quantity", ">", 0)
                    ->orderBy("quantity", "desc")
                    ->lockForUpdate()
                    ->get();

                foreach ($inventories as $inv) {
                    if ($remainingDeduction <= 0) {
                        break;
                    }
                    if ($inv->quantity >= $remainingDeduction) {
                        $inv->decrement("quantity", $remainingDeduction);
                        $remainingDeduction = 0;
                    } else {
                        $remainingDeduction -= $inv->quantity;
                        $inv->update(["quantity" => 0]);
                    }
                }
            }

            // 5. Create Transaction Log
            Transaction::create([
                "sale_id" => $sale->id,
                "payment_method" => $validated["payment_method"],
                "amount" => $calculatedTotal,
            ]);

            DB::commit();

            return redirect()->route("sales.index")->with("success", "POS Sale completed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show(Sale $sale)
    {
        $sale->load("customer", "items.product");
        return view("sales.show", compact("sale"));
    }

    public function edit(Sale $sale)
    {
        abort(404, "Editing completed sales is not allowed.");
    }

    public function update(Request $request, Sale $sale)
    {
        abort(404, "Updating completed sales is not allowed.");
    }

    public function destroy(Sale $sale)
    {
        DB::beginTransaction();

        try {
            // Restore inventory stock upon delete (rollback)
            foreach ($sale->items as $item) {
                $inventory = Inventory::where("product_id", $item->product_id)->first();
                if ($inventory) {
                    $inventory->increment("quantity", $item->quantity);
                }
            }

            // Delete associated transactions first or let Cascade delete do it (if cascade is active on foreign keys)
            Transaction::where('sale_id', $sale->id)->delete();

            $sale->delete();

            DB::commit();

            return redirect()->route("sales.index")->with("success", "Sale deleted successfully. Inventory rollback completed.");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
