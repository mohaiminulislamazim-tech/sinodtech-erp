<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Transaction;
use App\Models\Inventory;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCustomers = Customer::count();
        $totalEmployees = Employee::count();
        $totalBranches = Branch::count();
        $totalSales = Sale::count();
        $totalTransactions = Transaction::count();
        $totalInventory = Inventory::sum("quantity");

        // Live revenue widgets
        $todaysSales = Sale::whereDate("created_at", Carbon::today())->sum("total_amount");
        $monthlySales = Sale::whereMonth("created_at", Carbon::now()->month)->sum("total_amount");
        $allTimeRevenue = Sale::sum("total_amount");

        // Dynamic Calculations
        // Gross subtotal sum
        $allTimeSubtotal = Sale::sum("subtotal");
        $allTimeDiscount = Sale::sum("discount");
        
        // Profit margin is roughly 40% of the subtotal minus the discount given
        $allTimeProfit = ($allTimeSubtotal * 0.40) - $allTimeDiscount;
        if ($allTimeProfit < 0) $allTimeProfit = 0;

        // Est. Expenses is roughly 15% of subtotal as operating overhead
        $allTimeExpenses = $allTimeSubtotal * 0.15;

        // Tables & Lists
        $latestSales = Sale::with('customer')->latest()->take(5)->get();
        $latestCustomers = Customer::latest()->take(5)->get();
        $lowStockProducts = Inventory::where("quantity", "<", 10)->with("product")->take(5)->get();
        
        // Grab top 5 sold products with counts
        $topProducts = SaleItem::with("product")
            ->selectRaw("product_id, SUM(quantity) as total_quantity")
            ->groupBy("product_id")
            ->orderByDesc("total_quantity")
            ->take(5)
            ->get();

        // 30 Days sales trends for Chart.js
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $trends = Sale::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartLabels = $trends->pluck('date')->toArray();
        $chartValues = $trends->pluck('total')->map(fn($v) => (float)$v)->toArray();

        return view("dashboard", compact(
            "totalProducts",
            "totalCategories",
            "totalCustomers",
            "totalEmployees",
            "totalBranches",
            "totalSales",
            "totalTransactions",
            "totalInventory",
            "todaysSales",
            "monthlySales",
            "allTimeRevenue",
            "allTimeProfit",
            "allTimeExpenses",
            "latestSales",
            "latestCustomers",
            "lowStockProducts",
            "topProducts",
            "chartLabels",
            "chartValues"
        ));
    }
}
