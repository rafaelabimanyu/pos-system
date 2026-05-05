<x-app-layout>
    <x-slot name="title">Point of Sale</x-slot>

    <!-- Include Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="flex flex-col lg:flex-row gap-6 h-full" x-data="posSystem()">
        <!-- Left Side: Product Grid & Filters -->
        <div class="flex-1 flex flex-col min-h-0 lg:pr-2">
            
            <!-- Top Bar: Search & Categories -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-slate-400 dark:text-slate-500"></i>
                    </div>
                    <input type="text" x-model="searchQuery" @input.debounce.300ms="filterProducts" placeholder="Search products by name..." class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl leading-5 bg-white dark:bg-slate-800 placeholder-slate-400 dark:placeholder-slate-500 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-brand focus:border-brand sm:text-sm shadow-sm transition-all duration-300">
                </div>
                
                <!-- Category Badges -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 w-full sm:w-auto scrollbar-hide">
                    <button @click="setCategory(null)" :class="selectedCategory === null ? 'bg-brand text-slate-900 border-transparent font-bold shadow-md' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700'" class="px-4 py-2 text-sm font-medium rounded-xl border whitespace-nowrap shadow-sm transition-all duration-300">
                        All Items
                    </button>
                    @foreach($categories as $category)
                    <button @click="setCategory({{ $category->id }})" :class="selectedCategory === {{ $category->id }} ? 'bg-brand text-slate-900 border-transparent font-bold shadow-md' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700'" class="px-4 py-2 text-sm font-medium rounded-xl border whitespace-nowrap shadow-sm transition-all duration-300">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1 overflow-y-auto pb-24 lg:pb-4 pr-1">
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 lg:gap-6 pb-4">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div @click="addToCart(product)" class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden hover:shadow-lg hover:border-brand dark:hover:border-brand transition-all cursor-pointer group duration-300 transform hover:-translate-y-1">
                            <div class="h-32 bg-slate-100 dark:bg-slate-900/50 flex items-center justify-center relative">
                                <i data-lucide="package" class="h-12 w-12 text-slate-300 dark:text-slate-600 group-hover:scale-110 group-hover:text-brand transition-all duration-300"></i>
                                <span class="absolute top-2 right-2 bg-white/90 dark:bg-slate-800/90 text-slate-600 dark:text-slate-300 text-xs font-semibold px-2 py-1 rounded-md shadow-sm transition-colors duration-300" x-text="`${product.stock} in stock`"></span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white truncate transition-colors duration-300" x-text="product.name"></h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 transition-colors duration-300" x-text="product.category ? product.category.name : 'Uncategorized'"></p>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-brand dark:text-brand-hover font-extrabold text-base transition-colors duration-300" x-text="formatMoney(product.price)"></span>
                                    <div class="bg-brand/10 text-brand p-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Mobile Cart Floating Button -->
        <div class="fixed bottom-4 left-4 right-4 z-30 lg:hidden" x-show="cart.length > 0" x-transition>
            <button @click="cartOpen = true" class="w-full bg-brand text-slate-900 font-bold p-4 rounded-2xl shadow-xl shadow-brand/20 flex justify-between items-center transform hover:scale-[1.02] transition-transform">
                <div class="flex items-center gap-2">
                    <div class="bg-white/20 p-2 rounded-xl">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                    </div>
                    <span x-text="`${cart.length} items`"></span>
                </div>
                <div class="flex items-center gap-2">
                    <span x-text="formatMoney(total)"></span>
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
            </button>
        </div>

        <!-- Mobile Cart Backdrop -->
        <div x-show="cartOpen" 
             x-transition.opacity
             @click="cartOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
             style="display: none;"></div>

        <!-- Right Side: Shopping Cart Drawer / Sticky Sidebar -->
        <div :class="cartOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'" class="fixed inset-y-0 right-0 z-50 w-full sm:w-[400px] lg:static lg:w-96 bg-white dark:bg-slate-800 rounded-l-2xl lg:rounded-2xl shadow-2xl lg:shadow-sm border-l lg:border border-slate-200 dark:border-slate-700 flex flex-col flex-shrink-0 h-screen lg:h-[calc(100vh-6rem)] lg:sticky lg:top-4 transition-transform duration-300 ease-in-out">
            <!-- Cart Header -->
            <div class="p-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50 rounded-tl-2xl lg:rounded-t-2xl transition-colors duration-300">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-brand/10 rounded-xl">
                        <i data-lucide="shopping-cart" class="text-brand h-5 w-5"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white transition-colors duration-300">Current Order</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="clearCart" class="text-slate-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 transition-colors p-2 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30" title="Clear Order">
                        <i data-lucide="trash-2" class="h-5 w-5"></i>
                    </button>
                    <!-- Mobile Close Cart -->
                    <button @click="cartOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-2 rounded-xl hover:bg-slate-100">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-5 space-y-4">
                <template x-if="cart.length === 0">
                    <div class="h-full flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                        <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="shopping-cart" class="w-10 h-10 opacity-40"></i>
                        </div>
                        <p class="font-medium text-slate-500">Cart is empty</p>
                        <p class="text-xs mt-1 opacity-70">Add items from the menu</p>
                    </div>
                </template>

                <template x-for="item in cart" :key="item.id">
                    <div class="flex gap-4 items-center group bg-white dark:bg-slate-800 p-3 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white transition-colors duration-300 truncate" x-text="item.name"></h4>
                            <div class="text-xs font-medium text-brand mt-1 transition-colors duration-300" x-text="formatMoney(item.price)"></div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <div class="text-sm font-bold text-slate-900 dark:text-white transition-colors duration-300" x-text="formatMoney(item.price * item.quantity)"></div>
                            <div class="flex items-center gap-1 bg-slate-50 dark:bg-slate-900/50 p-1 rounded-lg border border-slate-200 dark:border-slate-700">
                                <button @click="decreaseQuantity(item)" class="w-6 h-6 rounded bg-white dark:bg-slate-800 shadow-sm text-slate-600 dark:text-slate-300 flex items-center justify-center hover:text-brand transition-colors duration-300">
                                    <i data-lucide="minus" class="h-3 w-3"></i>
                                </button>
                                <span class="text-xs font-bold w-6 text-center dark:text-white" x-text="item.quantity"></span>
                                <button @click="increaseQuantity(item)" class="w-6 h-6 rounded bg-brand text-slate-900 shadow-sm flex items-center justify-center hover:bg-brand-hover transition-colors duration-300" :disabled="item.quantity >= item.stock">
                                    <i data-lucide="plus" class="h-3 w-3"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Cart Summary & Payment -->
            <div class="p-5 bg-white dark:bg-slate-800 rounded-bl-2xl lg:rounded-b-2xl border-t border-slate-200 dark:border-slate-700 transition-colors duration-300 shadow-[0_-10px_20px_-15px_rgba(0,0,0,0.1)]">
                <div class="space-y-3 mb-5">
                    <div class="flex justify-between text-sm font-medium text-slate-500 dark:text-slate-400">
                        <span>Subtotal</span>
                        <span class="text-slate-700 dark:text-slate-200" x-text="formatMoney(subtotal)"></span>
                    </div>
                    <div class="pt-3 border-t border-dashed border-slate-200 dark:border-slate-700 flex justify-between items-end transition-colors duration-300">
                        <span class="text-base font-bold text-slate-900 dark:text-white">Total</span>
                        <span class="text-2xl font-black text-brand transition-colors duration-300" x-text="formatMoney(total)"></span>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="grid grid-cols-3 gap-3 mb-5">
                    <button @click="paymentMethod = 'cash'" :class="paymentMethod === 'cash' ? 'border-brand text-brand bg-brand/10 ring-2 ring-brand/20' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700'" class="py-3 border rounded-xl font-bold text-xs transition-all duration-300 flex flex-col items-center justify-center gap-2 shadow-sm">
                        <i data-lucide="banknote" class="h-5 w-5"></i> Cash
                    </button>
                    <button @click="paymentMethod = 'qris'" :class="paymentMethod === 'qris' ? 'border-brand text-brand bg-brand/10 ring-2 ring-brand/20' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700'" class="py-3 border rounded-xl font-bold text-xs transition-all duration-300 flex flex-col items-center justify-center gap-2 shadow-sm">
                        <i data-lucide="qr-code" class="h-5 w-5"></i> QRIS
                    </button>
                    <button @click="paymentMethod = 'card'" :class="paymentMethod === 'card' ? 'border-brand text-brand bg-brand/10 ring-2 ring-brand/20' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700'" class="py-3 border rounded-xl font-bold text-xs transition-all duration-300 flex flex-col items-center justify-center gap-2 shadow-sm">
                        <i data-lucide="credit-card" class="h-5 w-5"></i> Card
                    </button>
                </div>

                <button @click="checkout" :disabled="cart.length === 0 || processing" class="w-full py-4 bg-slate-900 hover:bg-slate-800 dark:bg-brand dark:hover:bg-brand-hover dark:text-slate-900 disabled:bg-slate-300 dark:disabled:bg-slate-700 disabled:cursor-not-allowed text-white rounded-2xl font-bold text-base shadow-xl transition-all flex items-center justify-center gap-2 duration-300 transform active:scale-95">
                    <span x-text="processing ? 'Processing...' : 'Complete Payment'"></span>
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
                cartOpen: false,
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
