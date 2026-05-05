<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $today = \Carbon\Carbon::today();
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        $baseQuery = Transaction::query();
        if ($user && $user->role === 'cashier') {
            $baseQuery->where('user_id', $user->id);
        }
        
        $dailySales = (clone $baseQuery)->whereDate('created_at', '=', $today->toDateString())->sum('total_amount');
        $totalOrders = (clone $baseQuery)->count();
        $lowStockCount = Product::query()->where('stock', '<', 10)->count();

        // Dummy data for the last 7 days chart
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('D, M d');
            $chartData[] = (clone $baseQuery)->whereDate('created_at', '=', $date->toDateString())->sum('total_amount');
        }

        return view('dashboard', compact('dailySales', 'totalOrders', 'lowStockCount', 'chartLabels', 'chartData'));
    }
}
