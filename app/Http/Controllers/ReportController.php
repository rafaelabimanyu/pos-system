<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

class ReportController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        $totalRevenue = $transactions->sum('total_amount');
        $totalOrders = $transactions->count();

        return view('reports.index', compact('transactions', 'totalRevenue', 'totalOrders'));
    }
}
