<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Transaction::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Cashier',
            'Payment Method',
            'Amount',
        ];
    }

    public function map($transaction): array
    {
        return [
            'TRX-' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT),
            $transaction->created_at->format('Y-m-d H:i:s'),
            $transaction->user->name ?? 'Unknown',
            strtoupper($transaction->payment_method),
            $transaction->total_amount,
        ];
    }
}
