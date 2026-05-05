<x-app-layout>
    <x-slot name="title">Point of Sale</x-slot>

    <div class="flex flex-col lg:flex-row gap-6 h-full">
        <!-- Left Side: Product Grid & Filters -->
        <div class="flex-1 flex flex-col min-h-0">
            
            <!-- Top Bar: Search & Categories -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-slate-400"></i>
                    </div>
                    <input type="text" placeholder="Search products by name or SKU..." class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm shadow-sm transition-all">
                </div>
                
                <!-- Category Badges -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 w-full sm:w-auto scrollbar-hide">
                    <button class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-sm hover:bg-primary-700 transition-colors">
                        All Items
                    </button>
                    <button class="px-4 py-2 bg-white text-slate-600 text-sm font-medium rounded-lg border border-slate-200 whitespace-nowrap shadow-sm hover:bg-slate-50 transition-colors">
                        Food
                    </button>
                    <button class="px-4 py-2 bg-white text-slate-600 text-sm font-medium rounded-lg border border-slate-200 whitespace-nowrap shadow-sm hover:bg-slate-50 transition-colors">
                        Beverages
                    </button>
                    <button class="px-4 py-2 bg-white text-slate-600 text-sm font-medium rounded-lg border border-slate-200 whitespace-nowrap shadow-sm hover:bg-slate-50 transition-colors">
                        Snacks
                    </button>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1 overflow-y-auto pr-2">
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 pb-4">
                    
                    <!-- Dummy Product Card 1 -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:border-primary-300 transition-all cursor-pointer group">
                        <div class="h-32 bg-slate-100 flex items-center justify-center relative">
                            <!-- Placeholder Image -->
                            <i data-lucide="coffee" class="h-12 w-12 text-slate-300 group-hover:scale-110 transition-transform"></i>
                            <span class="absolute top-2 right-2 bg-white/90 text-xs font-semibold px-2 py-1 rounded-md text-slate-600 shadow-sm">24 in stock</span>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-slate-900 truncate">Caramel Macchiato</h3>
                            <p class="text-xs text-slate-500 mt-1">Beverages</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-primary-600 font-bold">Rp 35.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dummy Product Card 2 -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:border-primary-300 transition-all cursor-pointer group">
                        <div class="h-32 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="croissant" class="h-12 w-12 text-slate-300 group-hover:scale-110 transition-transform"></i>
                            <span class="absolute top-2 right-2 bg-white/90 text-xs font-semibold px-2 py-1 rounded-md text-slate-600 shadow-sm">12 in stock</span>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-slate-900 truncate">Almond Croissant</h3>
                            <p class="text-xs text-slate-500 mt-1">Snacks</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-primary-600 font-bold">Rp 28.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dummy Product Card 3 -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:border-primary-300 transition-all cursor-pointer group">
                        <div class="h-32 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="pizza" class="h-12 w-12 text-slate-300 group-hover:scale-110 transition-transform"></i>
                            <span class="absolute top-2 right-2 bg-red-100 text-xs font-semibold px-2 py-1 rounded-md text-red-600 shadow-sm">2 in stock</span>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-slate-900 truncate">Pepperoni Pizza Slice</h3>
                            <p class="text-xs text-slate-500 mt-1">Food</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-primary-600 font-bold">Rp 45.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dummy Product Card 4 -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:border-primary-300 transition-all cursor-pointer group opacity-60">
                        <div class="h-32 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="cup-soda" class="h-12 w-12 text-slate-300 group-hover:scale-110 transition-transform"></i>
                            <span class="absolute top-2 right-2 bg-slate-200 text-xs font-semibold px-2 py-1 rounded-md text-slate-600 shadow-sm">Out of stock</span>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-slate-900 truncate">Iced Lemon Tea</h3>
                            <p class="text-xs text-slate-500 mt-1">Beverages</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-primary-600 font-bold">Rp 20.000</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dummy Product Card 5 -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:border-primary-300 transition-all cursor-pointer group">
                        <div class="h-32 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="cookie" class="h-12 w-12 text-slate-300 group-hover:scale-110 transition-transform"></i>
                            <span class="absolute top-2 right-2 bg-white/90 text-xs font-semibold px-2 py-1 rounded-md text-slate-600 shadow-sm">45 in stock</span>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-slate-900 truncate">Choco Chip Cookie</h3>
                            <p class="text-xs text-slate-500 mt-1">Snacks</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-primary-600 font-bold">Rp 15.000</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right Side: Shopping Cart -->
        <div class="w-full lg:w-96 bg-white rounded-2xl shadow-sm border border-slate-200 flex flex-col flex-shrink-0 h-[calc(100vh-8rem)] lg:h-auto">
            <!-- Cart Header -->
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 rounded-t-2xl">
                <div class="flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="text-primary-600 h-5 w-5"></i>
                    <h2 class="text-lg font-bold text-slate-900">Current Order</h2>
                </div>
                <button class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-md hover:bg-red-50" title="Clear Order">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                </button>
            </div>

            <!-- Customer Selection -->
            <div class="p-4 border-b border-slate-100">
                <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-lg p-2 px-3 cursor-pointer hover:bg-slate-100 transition-colors">
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <i data-lucide="user" class="h-4 w-4 text-slate-400"></i>
                        <span>Walk-in Customer</span>
                    </div>
                    <i data-lucide="chevron-down" class="h-4 w-4 text-slate-400"></i>
                </div>
            </div>

            <!-- Cart Items (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4">
                
                <!-- Cart Item 1 -->
                <div class="flex gap-3 items-start group">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-slate-900">Caramel Macchiato</h4>
                        <div class="text-xs text-slate-500 mt-0.5">Rp 35.000</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="w-7 h-7 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors">
                            <i data-lucide="minus" class="h-3 w-3"></i>
                        </button>
                        <span class="text-sm font-medium w-4 text-center">2</span>
                        <button class="w-7 h-7 rounded-md bg-primary-50 text-primary-600 flex items-center justify-center hover:bg-primary-100 transition-colors">
                            <i data-lucide="plus" class="h-3 w-3"></i>
                        </button>
                    </div>
                    <div class="text-sm font-bold text-slate-900 text-right w-20">
                        Rp 70.000
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div class="flex gap-3 items-start group">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-slate-900">Almond Croissant</h4>
                        <div class="text-xs text-slate-500 mt-0.5">Rp 28.000</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="w-7 h-7 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors">
                            <i data-lucide="minus" class="h-3 w-3"></i>
                        </button>
                        <span class="text-sm font-medium w-4 text-center">1</span>
                        <button class="w-7 h-7 rounded-md bg-primary-50 text-primary-600 flex items-center justify-center hover:bg-primary-100 transition-colors">
                            <i data-lucide="plus" class="h-3 w-3"></i>
                        </button>
                    </div>
                    <div class="text-sm font-bold text-slate-900 text-right w-20">
                        Rp 28.000
                    </div>
                </div>

            </div>

            <!-- Cart Summary & Payment -->
            <div class="p-4 bg-slate-50 rounded-b-2xl border-t border-slate-200">
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Subtotal</span>
                        <span class="font-medium text-slate-900">Rp 98.000</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Tax (11%)</span>
                        <span class="font-medium text-slate-900">Rp 10.780</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Discount</span>
                        <span class="font-medium text-green-600">- Rp 0</span>
                    </div>
                    <div class="pt-2 mt-2 border-t border-slate-200 flex justify-between items-end">
                        <span class="text-sm font-semibold text-slate-900">Total</span>
                        <span class="text-2xl font-bold text-primary-600">Rp 108.780</span>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="grid grid-cols-3 gap-2 mb-4">
                    <button class="py-2.5 bg-white border-2 border-primary-500 text-primary-600 rounded-xl font-medium text-sm hover:bg-primary-50 transition-colors flex flex-col items-center justify-center gap-1 shadow-sm relative overflow-hidden">
                        <div class="absolute inset-0 bg-primary-500/10 rounded-xl"></div>
                        <i data-lucide="banknote" class="h-4 w-4"></i>
                        Cash
                    </button>
                    <button class="py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-medium text-sm hover:bg-slate-50 transition-colors flex flex-col items-center justify-center gap-1 shadow-sm">
                        <i data-lucide="qr-code" class="h-4 w-4"></i>
                        QRIS
                    </button>
                    <button class="py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-medium text-sm hover:bg-slate-50 transition-colors flex flex-col items-center justify-center gap-1 shadow-sm">
                        <i data-lucide="credit-card" class="h-4 w-4"></i>
                        Card
                    </button>
                </div>

                <button class="w-full py-3.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-bold text-base shadow-lg shadow-primary-500/30 transition-all flex items-center justify-center gap-2">
                    Charge Rp 108.780
                    <i data-lucide="arrow-right" class="h-5 w-5"></i>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
