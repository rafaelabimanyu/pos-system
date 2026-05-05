<x-app-layout>
    <x-slot name="title">Sales Reports</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Sales Reports</h1>
            <p class="text-slate-500 mt-1">Overview of your business performance.</p>
        </div>
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-4 py-2 rounded-lg hover:bg-slate-50 transition-colors shadow-sm font-medium">
            <i data-lucide="printer" class="w-4 h-4"></i>
            Print / Export
        </button>
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
