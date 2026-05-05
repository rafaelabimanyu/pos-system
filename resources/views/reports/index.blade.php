<x-app-layout>
    <x-slot name="title">Sales Reports</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white transition-colors duration-300">Sales Reports</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 transition-colors duration-300">Overview of your business performance.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <form action="{{ route('reports.index') }}" method="GET" class="flex items-center gap-2">
                <select name="range" onchange="this.form.submit()" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                    <option value="all" {{ $range === 'all' ? 'selected' : '' }}>All Time</option>
                    <option value="daily" {{ $range === 'daily' ? 'selected' : '' }}>Today</option>
                    <option value="weekly" {{ $range === 'weekly' ? 'selected' : '' }}>This Week</option>
                    <option value="monthly" {{ $range === 'monthly' ? 'selected' : '' }}>This Month</option>
                </select>
            </form>
            <a href="{{ route('reports.export.pdf') }}" target="_blank" class="inline-flex items-center gap-2 bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-400 px-4 py-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors shadow-sm font-medium text-sm">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                PDF
            </a>
            <a href="{{ route('reports.export.excel') }}" class="inline-flex items-center gap-2 bg-green-50 text-green-600 dark:bg-green-900/30 dark:text-green-400 px-4 py-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors shadow-sm font-medium text-sm">
                <i data-lucide="sheet" class="w-4 h-4"></i>
                Excel
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Revenue Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-sm text-white relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 transition-transform group-hover:scale-110"></div>
            <div class="flex items-center justify-between mb-4 relative z-10">
                <h3 class="text-blue-100 font-medium">Total Revenue</h3>
                <div class="p-2 bg-white/20 rounded-lg">
                    <i data-lucide="dollar-sign" class="w-5 h-5 text-white"></i>
                </div>
            </div>
            <p class="text-3xl font-bold relative z-10">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <!-- Orders Card -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 font-medium">Total Transactions</h3>
                <div class="p-2 bg-blue-50 rounded-lg">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-blue-600"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $totalOrders }}</p>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">Recent Transactions</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-600 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Transaction ID</th>
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold">Cashier</th>
                        <th class="px-6 py-4 font-semibold">Payment Method</th>
                        <th class="px-6 py-4 font-semibold text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-blue-600">
                                #TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                {{ $transaction->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-slate-700">
                                {{ $transaction->user->name ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 uppercase">
                                    {{ $transaction->payment_method }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                No transactions found yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
