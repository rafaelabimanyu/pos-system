<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-slate-500 mt-1">Welcome back, {{ auth()->user()->name }}! Here's what's happening today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Daily Sales -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 font-medium">Daily Sales</h3>
                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-900">Rp {{ number_format($dailySales, 0, ',', '.') }}</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 font-medium">Total Orders</h3>
                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $totalOrders }}</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 font-medium">Low Stock Items</h3>
                <div class="p-2.5 bg-red-50 text-red-600 rounded-xl group-hover:scale-110 transition-transform">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $lowStockCount }}</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
        </div>

    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-slate-900">Sales Trends (Last 7 Days)</h2>
        </div>
        <div class="relative h-72 w-full">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            // Create a gradient for the area under the line
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)'); // blue-500
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

            const data = {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Revenue (Rp)',
                    data: @json($chartData),
                    borderColor: '#3b82f6', // blue-500
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // smooth curves
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b', // slate-800
                            titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                            bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 14, weight: 'bold' },
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9', // slate-100
                                drawBorder: false,
                            },
                            ticks: {
                                font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                                color: '#64748b', // slate-500
                                callback: function(value, index, values) {
                                    if (value === 0) return '0';
                                    return 'Rp ' + (value / 1000) + 'k';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                                color: '#64748b' // slate-500
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            };

            new Chart(ctx, config);
        });
    </script>
</x-app-layout>
