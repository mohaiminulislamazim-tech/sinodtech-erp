<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report: {{ strtoupper($type) }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            font-size: 13px;
        }
        .header {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
        }
        .subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 5px;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 12px;
            border-collapse: collapse;
        }
        .meta-table td {
            padding: 4px 0;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .report-table th {
            background-color: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
            padding: 8px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            color: #4b5563;
            text-align: left;
        }
        .report-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">SINODTECH ERP</div>
        <div class="subtitle">System Generated Business Analytics & Auditing Report</div>
    </div>

    <table class="meta-table">
        <tr>
            <td style="width: 50%;">
                <strong>Report Type:</strong> {{ strtoupper($type) }} REPORT<br>
                <strong>Date Range:</strong> {{ $startDate }} to {{ $endDate }}
            </td>
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <strong>Printed On:</strong> {{ now()->format('d M Y, H:i') }}
            </td>
        </tr>
    </table>

    <table class="report-table">
        <thead>
            @if ($type === 'sales' || $type === 'profit')
                <tr>
                    <th>Date</th>
                    <th class="text-center">Count</th>
                    <th class="text-right">Subtotal</th>
                    <th class="text-right">Discount</th>
                    <th class="text-right">Tax</th>
                    <th class="text-right">Revenue</th>
                    <th class="text-right">Est. Profit</th>
                </tr>
            @elseif ($type === 'inventory' || $type === 'low_stock')
                <tr>
                    <th>Product Name</th>
                    <th>Branch Location</th>
                    <th class="text-right">Stock Level</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total Asset Cost</th>
                </tr>
            @elseif ($type === 'customers')
                <tr>
                    <th>Customer Name</th>
                    <th>Email Address</th>
                    <th class="text-center">Transactions</th>
                    <th class="text-right">Total Spent</th>
                </tr>
            @elseif ($type === 'employee')
                <tr>
                    <th>Employee Name</th>
                    <th>Email Address</th>
                    <th>Role Title</th>
                    <th>Hire Date</th>
                </tr>
            @elseif ($type === 'branch')
                <tr>
                    <th>Branch Name</th>
                    <th>Location</th>
                    <th class="text-right">Sales Volume</th>
                    <th class="text-right">Assets Cost Value</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($data['records'] as $row)
                @if ($type === 'sales' || $type === 'profit')
                    <tr>
                        <td class="bold">{{ $row->date }}</td>
                        <td class="text-center">{{ $row->count }}</td>
                        <td class="text-right">${{ number_format($row->subtotal, 2) }}</td>
                        <td class="text-right">-${{ number_format($row->discount, 2) }}</td>
                        <td class="text-right">${{ number_format($row->tax, 2) }}</td>
                        <td class="text-right bold">${{ number_format($row->revenue, 2) }}</td>
                        <td class="text-right bold" style="color: #16a34a;">${{ number_format($row->profit, 2) }}</td>
                    </tr>
                @elseif ($type === 'inventory' || $type === 'low_stock')
                    <tr>
                        <td class="bold">{{ $row->product_name }}</td>
                        <td>{{ $row->branch_name ?? 'Main Warehouse' }}</td>
                        <td class="text-right">{{ $row->quantity }} units</td>
                        <td class="text-right">${{ number_format($row->price, 2) }}</td>
                        <td class="text-right bold">${{ number_format($row->asset_value, 2) }}</td>
                    </tr>
                @elseif ($type === 'customers')
                    <tr>
                        <td class="bold">{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td class="text-center">{{ $row->sales_count }} sales</td>
                        <td class="text-right bold">${{ number_format($row->total_spent, 2) }}</td>
                    </tr>
                @elseif ($type === 'employee')
                    <tr>
                        <td class="bold">{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->role_title ?? 'Employee' }}</td>
                        <td>{{ $row->hire_date }}</td>
                    </tr>
                @elseif ($type === 'branch')
                    <tr>
                        <td class="bold">{{ $row->name }}</td>
                        <td>{{ $row->location }}</td>
                        <td class="text-right bold" style="color: #16a34a;">${{ number_format($row->sales_volume ?? 0, 2) }}</td>
                        <td class="text-right bold">${{ number_format($row->asset_value ?? 0, 2) }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="10" class="text-center" style="padding: 20px; color: #9ca3af;">No record compiled for this date range.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 30px; text-align: center; font-size: 11px; color: #9ca3af; border-top: 1px solid #f3f4f6; padding-top: 15px;">
        © 2026 Mohaiminul Islam
    </div>
</body>
</html>
