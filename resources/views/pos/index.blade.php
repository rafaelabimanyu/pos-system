<x-app-layout>
    <x-slot name="title">Point of Sale</x-slot>

    <!-- Include Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="flex flex-col lg:flex-row gap-6 h-full" x-data="posSystem()">
        <!-- Left Side: Product Grid & Filters -->
        <div class="flex-1 flex flex-col min-h-0">
            
            <!-- Top Bar: Search & Categories -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-slate-400"></i>
                    </div>
                    <input type="text" x-model="searchQuery" @input.debounce.300ms="filterProducts" placeholder="Search products by name..." class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm shadow-sm transition-all">
                </div>
                
                <!-- Category Badges -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 w-full sm:w-auto scrollbar-hide">
                    <button @click="setCategory(null)" :class="selectedCategory === null ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-sm font-medium rounded-lg border whitespace-nowrap shadow-sm transition-colors">
                        All Items
                    </button>
                    @foreach($categories as $category)
                    <button @click="setCategory({{ $category->id }})" :class="selectedCategory === {{ $category->id }} ? 'bg-blue-600 text-white border-transparent' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'" class="px-4 py-2 text-sm font-medium rounded-lg border whitespace-nowrap shadow-sm transition-colors">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1 overflow-y-auto pr-2">
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 pb-4">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div @click="addToCart(product)" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md hover:border-blue-300 transition-all cursor-pointer group">
                            <div class="h-32 bg-slate-100 flex items-center justify-center relative">
                                <i data-lucide="package" class="h-12 w-12 text-slate-300 group-hover:scale-110 transition-transform"></i>
                                <span class="absolute top-2 right-2 bg-white/90 text-xs font-semibold px-2 py-1 rounded-md text-slate-600 shadow-sm" x-text="`${product.stock} in stock`"></span>
                            </div>
                            <div class="p-3">
                                <h3 class="text-sm font-semibold text-slate-900 truncate" x-text="product.name"></h3>
                                <p class="text-xs text-slate-500 mt-1" x-text="product.category ? product.category.name : 'Uncategorized'"></p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-blue-600 font-bold" x-text="formatMoney(product.price)"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Right Side: Shopping Cart -->
        <div class="w-full lg:w-96 bg-white rounded-2xl shadow-sm border border-slate-200 flex flex-col flex-shrink-0 h-[calc(100vh-8rem)] lg:h-auto">
            <!-- Cart Header -->
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 rounded-t-2xl">
                <div class="flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="text-blue-600 h-5 w-5"></i>
                    <h2 class="text-lg font-bold text-slate-900">Current Order</h2>
                </div>
                <button @click="clearCart" class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-md hover:bg-red-50" title="Clear Order">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                </button>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4">
                <template x-if="cart.length === 0">
                    <div class="h-full flex flex-col items-center justify-center text-slate-400">
                        <i data-lucide="shopping-cart" class="w-12 h-12 mb-3 opacity-20"></i>
                        <p class="text-sm">Cart is empty</p>
                    </div>
                </template>

                <template x-for="item in cart" :key="item.id">
                    <div class="flex gap-3 items-start group">
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-slate-900" x-text="item.name"></h4>
                            <div class="text-xs text-slate-500 mt-0.5" x-text="formatMoney(item.price)"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="decreaseQuantity(item)" class="w-7 h-7 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors">
                                <i data-lucide="minus" class="h-3 w-3"></i>
                            </button>
                            <span class="text-sm font-medium w-4 text-center" x-text="item.quantity"></span>
                            <button @click="increaseQuantity(item)" class="w-7 h-7 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors" :disabled="item.quantity >= item.stock">
                                <i data-lucide="plus" class="h-3 w-3"></i>
                            </button>
                        </div>
                        <div class="text-sm font-bold text-slate-900 text-right w-20" x-text="formatMoney(item.price * item.quantity)"></div>
                    </div>
                </template>
            </div>

            <!-- Cart Summary & Payment -->
            <div class="p-4 bg-slate-50 rounded-b-2xl border-t border-slate-200">
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Subtotal</span>
                        <span class="font-medium text-slate-900" x-text="formatMoney(subtotal)"></span>
                    </div>
                    <div class="pt-2 mt-2 border-t border-slate-200 flex justify-between items-end">
                        <span class="text-sm font-semibold text-slate-900">Total</span>
                        <span class="text-2xl font-bold text-blue-600" x-text="formatMoney(total)"></span>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="grid grid-cols-3 gap-2 mb-4">
                    <button @click="paymentMethod = 'cash'" :class="paymentMethod === 'cash' ? 'border-blue-500 text-blue-600 bg-blue-50' : 'border-slate-200 text-slate-600 bg-white hover:bg-slate-50'" class="py-2.5 border-2 rounded-xl font-medium text-sm transition-colors flex flex-col items-center justify-center gap-1 shadow-sm relative overflow-hidden">
                        <i data-lucide="banknote" class="h-4 w-4"></i> Cash
                    </button>
                    <button @click="paymentMethod = 'qris'" :class="paymentMethod === 'qris' ? 'border-blue-500 text-blue-600 bg-blue-50' : 'border-slate-200 text-slate-600 bg-white hover:bg-slate-50'" class="py-2.5 border-2 rounded-xl font-medium text-sm transition-colors flex flex-col items-center justify-center gap-1 shadow-sm">
                        <i data-lucide="qr-code" class="h-4 w-4"></i> QRIS
                    </button>
                    <button @click="paymentMethod = 'card'" :class="paymentMethod === 'card' ? 'border-blue-500 text-blue-600 bg-blue-50' : 'border-slate-200 text-slate-600 bg-white hover:bg-slate-50'" class="py-2.5 border-2 rounded-xl font-medium text-sm transition-colors flex flex-col items-center justify-center gap-1 shadow-sm">
                        <i data-lucide="credit-card" class="h-4 w-4"></i> Card
                    </button>
                </div>

                <button @click="checkout" :disabled="cart.length === 0 || processing" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed text-white rounded-xl font-bold text-base shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center gap-2">
                    <span x-text="processing ? 'Processing...' : 'Charge ' + formatMoney(total)"></span>
                    <i data-lucide="arrow-right" class="h-5 w-5" x-show="!processing"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function posSystem() {
            return {
                products: @json($products),
                searchQuery: '',
                selectedCategory: null,
                cart: [],
                paymentMethod: 'cash',
                processing: false,

                get filteredProducts() {
                    return this.products.filter(product => {
                        const matchCategory = this.selectedCategory === null || product.category_id === this.selectedCategory;
                        const matchSearch = product.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCategory && matchSearch;
                    });
                },

                get subtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                get total() {
                    return this.subtotal; // Add tax here if needed
                },

                setCategory(id) {
                    this.selectedCategory = id;
                },

                filterProducts() {
                    // Handled by getter
                },

                addToCart(product) {
                    const existingItem = this.cart.find(item => item.id === product.id);
                    if (existingItem) {
                        if (existingItem.quantity < product.stock) {
                            existingItem.quantity++;
                        }
                    } else {
                        this.cart.push({
                            ...product,
                            quantity: 1
                        });
                    }
                },

                increaseQuantity(item) {
                    if (item.quantity < item.stock) {
                        item.quantity++;
                    }
                },

                decreaseQuantity(item) {
                    if (item.quantity > 1) {
                        item.quantity--;
                    } else {
                        this.cart = this.cart.filter(i => i.id !== item.id);
                    }
                },

                clearCart() {
                    if(confirm('Are you sure you want to clear the cart?')) {
                        this.cart = [];
                    }
                },

                formatMoney(amount) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
                },

                async checkout() {
                    if (this.cart.length === 0) return;
                    
                    this.processing = true;

                    try {
                        const response = await fetch('{{ route("pos.checkout") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                items: this.cart.map(item => ({ id: item.id, quantity: item.quantity })),
                                payment_method: this.paymentMethod,
                                total_amount: this.total
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert('Transaction successful!');
                            window.location.reload(); // Reload to refresh stock and clear cart
                        } else {
                            alert('Error: ' + data.message);
                        }
                    } catch (error) {
                        alert('An error occurred during checkout.');
                    } finally {
                        this.processing = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
