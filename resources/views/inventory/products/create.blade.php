<x-app-layout>
    <x-slot name="title">Add Product</x-slot>

    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 transition-colors mb-4 text-sm font-medium">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Inventory
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Add New Product</h1>
        <p class="text-slate-500 mt-1">Enter the details of the new product.</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden max-w-3xl">
        <form action="{{ route('products.store') }}" method="POST" class="p-6 md:p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Name -->
                <div class="col-span-1 md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border transition duration-150 ease-in-out">
                    @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                    <select name="category_id" id="category_id" required
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border transition duration-150 ease-in-out bg-white">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-slate-700 mb-1">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required min="0"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border transition duration-150 ease-in-out">
                    @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-slate-700 mb-1">Initial Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required min="0"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border transition duration-150 ease-in-out">
                    @error('stock') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <!-- Description -->
                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description (Optional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border transition duration-150 ease-in-out">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors shadow-sm font-medium flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Save Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
