<x-app-layout>
    <x-slot name="title">Inventory</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Products Inventory</h1>
            <p class="text-slate-500 mt-1">Manage your products and stock levels.</p>
        </div>
        <a href="{{ route('products.create') }}"
            class="inline-flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors shadow-sm font-medium">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Product
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-600 p-4 rounded-lg border border-green-100 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-600 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">Category</th>
                        <th class="px-6 py-4 font-semibold">Price</th>
                        <th class="px-6 py-4 font-semibold">Stock</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $product->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    {{ $product->category->name ?? 'None' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if ($product->stock > 10)
                                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    @elseif ($product->stock > 0)
                                        <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                    @else
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                    @endif
                                    {{ $product->stock }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="p-2 text-slate-400 hover:text-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="package-open" class="w-12 h-12 text-slate-300 mb-3"></i>
                                    <p>No products found in inventory.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
