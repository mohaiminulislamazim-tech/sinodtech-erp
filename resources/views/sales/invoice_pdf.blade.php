<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $sale->id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }
        .header-table, .details-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            padding: 0;
            vertical-align: top;
        }
        .title {
            font-size: 32px;
            font-weight: bold;
            color: #4f46e5;
        }
        .invoice-details {
            text-align: right;
        }
        .details-table td {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .items-table th {
            background-color: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
            padding: 10px;
            font-size: 12px;
            text-transform: uppercase;
            color: #4b5563;
        }
        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
        }
        .text-right {
            text-align: right;
        }
        .totals-table {
            width: 40%;
            margin-left: 60%;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 8px 10px;
            font-size: 14px;
        }
        .totals-table tr.grand-total {
            font-weight: bold;
            font-size: 16px;
            color: #111827;
            border-top: 2px solid #e5e7eb;
        }
        .badge {
            background-color: #e0e7ff;
            color: #4338ca;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="header-table">
            <tr>
                <td>
                    <div class="title">SINODTECH ERP</div>
                    <div style="color: #6b7280; font-size: 12px; margin-top: 5px;">
                        123 Business Avenue, Suite 100<br>
                        Contact: support@sinodtech.com | +1 (555) 123-4567
                    </div>
                </td>
                <td class="invoice-details">
                    <h2 style="margin: 0; color: #111827;">INVOICE</h2>
                    <div style="margin-top: 5px; color: #4b5563;">
                        <strong>Invoice ID:</strong> #{{ $sale->id }}<br>
                        <strong>Date:</strong> {{ $sale->created_at->format('d M Y') }}<br>
                        <strong>Payment Method:</strong> <span class="badge">{{ $sale->payment_method }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <table class="details-table">
            <tr>
                <td style="width: 50%;">
                    <h4 style="margin: 0 0 5px 0; color: #4b5563; text-transform: uppercase; font-size: 12px;">Customer Details:</h4>
                    <strong>Name:</strong> {{ $sale->customer->name ?? 'Walk-in Customer' }}<br>
                    <strong>Email:</strong> {{ $sale->customer->email ?? 'N/A' }}<br>
                    <strong>Phone:</strong> {{ $sale->customer->phone ?? 'N/A' }}
                </td>
                <td style="width: 50%; text-align: right; vertical-align: bottom;">
                    <!-- Additional metadata if any -->
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-right" style="width: 15%;">Qty</th>
                    <th class="text-right" style="width: 20%;">Price</th>
                    <th class="text-right" style="width: 25%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product->name ?? 'Unknown Product' }}</strong>
                        </td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">${{ number_format($item->price, 2) }}</td>
                        <td class="text-right">${{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">${{ number_format($sale->subtotal, 2) }}</td>
            </tr>
            @if($sale->discount > 0)
                <tr>
                    <td style="color: #b91c1c;">Discount:</td>
                    <td class="text-right" style="color: #b91c1c;">-${{ number_format($sale->discount, 2) }}</td>
                </tr>
            @endif
            @if($sale->tax > 0)
                <tr>
                    <td>Tax:</td>
                    <td class="text-right">${{ number_format($sale->tax, 2) }}</td>
                </tr>
            @endif
            @if($sale->shipping > 0)
                <tr>
                    <td>Shipping:</td>
                    <td class="text-right">${{ number_format($sale->shipping, 2) }}</td>
                </tr>
            @endif
            <tr class="grand-total">
                <td>Grand Total:</td>
                <td class="text-right">${{ number_format($sale->total_amount, 2) }}</td>
            </tr>
        </table>

        <div class="footer">
            <p style="margin-bottom: 5px;">Thank you for your business! If you have any questions, please contact support.</p>
            <p style="margin-top: 0; font-weight: bold; color: #4b5563;">© 2026 Mohaiminul Islam</p>
        </div>
    </div>
</body>
</html>
