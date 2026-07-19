<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'sales');
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));
        $branchId = $request->get('branch_id');

        $data = $this->getReportData($type, $startDate, $endDate, $branchId);
        $branches = Branch::all();

        return view('reports.index', compact('data', 'type', 'startDate', 'endDate', 'branchId', 'branches'));
    }

    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'sales');
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));
        $branchId = $request->get('branch_id');

        $data = $this->getReportData($type, $startDate, $endDate, $branchId);
        
        $pdf = Pdf::loadView('reports.pdf', compact('data', 'type', 'startDate', 'endDate'));
        return $pdf->download("report-{$type}-{$startDate}-to-{$endDate}.pdf");
    }

    public function exportExcel(Request $request)
    {
        $type = $request->get('type', 'sales');
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));
        $branchId = $request->get('branch_id');

        $data = $this->getReportData($type, $startDate, $endDate, $branchId);

        $filename = "report-{$type}-{$startDate}-to-{$endDate}.csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($data, $type) {
            $file = fopen('php://output', 'w');

            // Header Row
            if ($type === 'sales' || $type === 'profit') {
                fputcsv($file, ['Date', 'Sales Count', 'Subtotal ($)', 'Discount ($)', 'Tax ($)', 'Shipping ($)', 'Total Revenue ($)', 'Estimated Profit ($)']);
                foreach ($data['records'] as $row) {
                    fputcsv($file, [
                        $row->date,
                        $row->count,
                        number_format($row->subtotal, 2, '.', ''),
                        number_format($row->discount, 2, '.', ''),
                        number_format($row->tax, 2, '.', ''),
                        number_format($row->shipping, 2, '.', ''),
                        number_format($row->revenue, 2, '.', ''),
                        number_format($row->profit, 2, '.', '')
                    ]);
                }
            } elseif ($type === 'inventory' || $type === 'low_stock') {
                fputcsv($file, ['Product Name', 'Branch', 'In-Stock Quantity', 'Unit Price ($)', 'Asset Value ($)']);
                foreach ($data['records'] as $row) {
                    fputcsv($file, [
                        $row->product_name,
                        $row->branch_name,
                        $row->quantity,
                        number_format($row->price, 2, '.', ''),
                        number_format($row->asset_value, 2, '.', '')
                    ]);
                }
            } elseif ($type === 'customers') {
                fputcsv($file, ['Customer Name', 'Email', 'Sales Count', 'Total Spent ($)']);
                foreach ($data['records'] as $row) {
                    fputcsv($file, [
                        $row->name,
                        $row->email,
                        $row->sales_count,
                        number_format($row->total_spent, 2, '.', '')
                    ]);
                }
            } elseif ($type === 'employee') {
                fputcsv($file, ['Employee Name', 'Email', 'Role', 'Hire Date']);
                foreach ($data['records'] as $row) {
                    fputcsv($file, [
                        $row->name,
                        $row->email,
                        $row->role_title ?? 'Employee',
                        $row->hire_date
                    ]);
                }
            } elseif ($type === 'branch') {
                fputcsv($file, ['Branch Name', 'Location', 'Sales Volume ($)', 'Stock Asset Value ($)']);
                foreach ($data['records'] as $row) {
                    fputcsv($file, [
                        $row->name,
                        $row->location,
                        number_format($row->sales_volume ?? 0, 2, '.', ''),
                        number_format($row->asset_value ?? 0, 2, '.', '')
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getReportData($type, $startDate, $endDate, $branchId = null)
    {
        $data = [
            'type' => $type,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'records' => [],
            'summary' => []
        ];

        $start = $startDate . ' 00:00:00';
        $end = $endDate . ' 23:59:59';

        if ($type === 'sales' || $type === 'profit') {
            // Aggregate daily sales
            $query = DB::table('sales')
                ->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(id) as count'),
                    DB::raw('SUM(subtotal) as subtotal'),
                    DB::raw('SUM(discount) as discount'),
                    DB::raw('SUM(tax) as tax'),
                    DB::raw('SUM(shipping) as shipping'),
                    DB::raw('SUM(total_amount) as revenue')
                )
                ->whereBetween('created_at', [$start, $end]);

            $records = $query->groupBy('date')->orderBy('date', 'desc')->get();

            // Calculate mock profit (approx 40% margin on gross subtotal)
            foreach ($records as $record) {
                $record->profit = ($record->subtotal * 0.40) - $record->discount;
                if ($record->profit < 0) $record->profit = 0;
            }

            $data['records'] = $records;
            $data['summary'] = [
                'total_count' => $records->sum('count'),
                'total_revenue' => $records->sum('revenue'),
                'total_discount' => $records->sum('discount'),
                'total_tax' => $records->sum('tax'),
                'total_profit' => $records->sum('profit')
            ];
        } elseif ($type === 'inventory' || $type === 'low_stock') {
            $query = DB::table('inventories')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('branches', 'inventories.branch_id', '=', 'branches.id')
                ->select(
                    'products.name as product_name',
                    'products.price as price',
                    'branches.name as branch_name',
                    'inventories.quantity as quantity',
                    DB::raw('inventories.quantity * products.price as asset_value')
                );

            if ($type === 'low_stock') {
                $query->where('inventories.quantity', '<', 10);
            }

            if ($branchId) {
                $query->where('inventories.branch_id', $branchId);
            }

            $records = $query->orderBy('inventories.quantity', 'asc')->get();

            $data['records'] = $records;
            $data['summary'] = [
                'total_items' => $records->count(),
                'total_quantity' => $records->sum('quantity'),
                'total_asset_value' => $records->sum('asset_value')
            ];
        } elseif ($type === 'customers') {
            // Purchases summary per customer
            $records = DB::table('customers')
                ->leftJoin('sales', 'customers.id', '=', 'sales.customer_id')
                ->select(
                    'customers.name',
                    'customers.email',
                    DB::raw('COUNT(sales.id) as sales_count'),
                    DB::raw('SUM(sales.total_amount) as total_spent')
                )
                ->groupBy('customers.id', 'customers.name', 'customers.email')
                ->orderBy('total_spent', 'desc')
                ->get();

            foreach ($records as $r) {
                $r->total_spent = $r->total_spent ?? 0;
            }

            $data['records'] = $records;
            $data['summary'] = [
                'total_customers' => $records->count(),
                'active_customers' => $records->where('sales_count', '>', 0)->count(),
                'total_revenue' => $records->sum('total_spent')
            ];
        } elseif ($type === 'employee') {
            // Role and Hire date details
            $records = DB::table('employees')
                ->leftJoin('roles', 'employees.role_id', '=', 'roles.id')
                ->select(
                    'employees.name',
                    'employees.email',
                    'employees.hire_date',
                    'roles.title as role_title'
                )
                ->orderBy('employees.name', 'asc')
                ->get();

            $data['records'] = $records;
            $data['summary'] = [
                'total_employees' => $records->count()
            ];
        } elseif ($type === 'branch') {
            // Branch performance
            $records = DB::table('branches')
                ->leftJoin('inventories', 'branches.id', '=', 'inventories.branch_id')
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->select(
                    'branches.name',
                    'branches.location',
                    DB::raw('SUM(inventories.quantity * products.price) as asset_value')
                )
                ->groupBy('branches.id', 'branches.name', 'branches.location')
                ->get();

            // Mock sales volume per branch
            foreach($records as $r) {
                $r->sales_volume = $r->asset_value * 0.85; // Simulated performance
            }

            $data['records'] = $records;
            $data['summary'] = [
                'total_branches' => $records->count(),
                'total_asset_value' => $records->sum('asset_value')
            ];
        }

        return $data;
    }
}
