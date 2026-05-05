<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $today = \Carbon\Carbon::today();
        
        $dailySales = Transaction::whereDate('created_at', $today)->sum('total_amount');
        $totalOrders = Transaction::count();
        $lowStockCount = Product::where('stock', '<', 10)->count();

        // Dummy data for the last 7 days chart
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('D, M d');
            $chartData[] = Transaction::whereDate('created_at', $date)->sum('total_amount');
        }

        return view('dashboard', compact('dailySales', 'totalOrders', 'lowStockCount', 'chartLabels', 'chartData'));
    }
}
