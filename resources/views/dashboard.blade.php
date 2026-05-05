<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Dashboard Overview</h1>
        <p class="text-slate-500 mt-1">Welcome back, Admin. Here's what's happening today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stat Card Placeholder -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Sales</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">Rp 4.500.000</p>
                </div>
                <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 font-medium flex items-center"><i data-lucide="arrow-up" class="w-4 h-4 mr-1"></i> 12.5%</span>
                <span class="text-slate-400 ml-2">from yesterday</span>
            </div>
        </div>
    </div>
</x-app-layout>
