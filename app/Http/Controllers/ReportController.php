<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->input('range', 'all');
        $query = Transaction::with('user')->latest();

        if ($range === 'daily') {
            $query->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString());
        } elseif ($range === 'weekly') {
            $query->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
        } elseif ($range === 'monthly') {
            $query->whereMonth('created_at', '=', \Carbon\Carbon::now()->month)
                  ->whereYear('created_at', '=', \Carbon\Carbon::now()->year);
        }

        $transactions = $query->get();
        $totalRevenue = $transactions->sum('total_amount');
        $totalOrders = $transactions->count();

        return view('reports.index', compact('transactions', 'totalRevenue', 'totalOrders', 'range'));
    }

    public function exportPdf(Request $request)
    {
        $transactions = Transaction::with('user')->latest()->get(); // Basic for now, can apply filters if passed
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf', compact('transactions'));
        return $pdf->download('transactions_report.pdf');
    }

    public function exportExcel(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\TransactionsExport, 'transactions_report.xlsx');
    }
}
