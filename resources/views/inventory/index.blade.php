<x-app-layout>
    <x-slot name="title">Inventory Management</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Inventory Management</h1>
            <p class="text-slate-500 mt-1">Manage products, categories, and stock levels.</p>
        </div>
        <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium shadow-sm transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Product
        </button>
    </div>

    <!-- Inventory Table Placeholder -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
            <div class="relative w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="search" class="h-4 w-4 text-slate-400"></i>
                </div>
                <input type="text" placeholder="Search inventory..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
            </div>
            <button class="px-3 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4"></i>
                Filters
            </button>
        </div>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Product Info</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">SKU</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Category</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Price</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Stock</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="coffee" class="w-5 h-5 text-slate-400"></i>
                            </div>
                            <span class="font-medium text-slate-900">Caramel Macchiato</span>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-sm text-slate-600">BEV-001</td>
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-700/10">Beverages</span>
                    </td>
                    <td class="py-3 px-4 text-sm font-medium text-slate-900 text-right">Rp 35.000</td>
                    <td class="py-3 px-4 text-sm text-slate-600 text-right">24</td>
                    <td class="py-3 px-4 text-center">
                        <button class="text-slate-400 hover:text-primary-600 mx-1"><i data-lucide="edit" class="w-4 h-4"></i></button>
                        <button class="text-slate-400 hover:text-red-600 mx-1"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
