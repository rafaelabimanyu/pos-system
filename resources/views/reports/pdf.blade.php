<!DOCTYPE html>
<html>
<head>
    <title>Transactions Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $globalSettings['app_name'] ?? 'POS Rico' }}</h2>
        <h3>Transactions Report</h3>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Cashier</th>
                <th>Payment</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                <td>{{ $transaction->user->name ?? 'Unknown' }}</td>
                <td>{{ strtoupper($transaction->payment_method) }}</td>
                <td class="text-right">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Revenue:</th>
                <th class="text-right">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
