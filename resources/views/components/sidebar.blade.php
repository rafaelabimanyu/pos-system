<aside class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex z-10 transition-all duration-300">
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 border-b border-slate-100">
        <div class="flex items-center gap-2 text-primary-600">
            <i data-lucide="store" class="w-6 h-6"></i>
            <span class="font-bold text-xl tracking-tight">POS Carolina</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-4">Main Menu</p>
        
        <a href="/dashboard" class="{{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="layout-dashboard" class="{{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }} mr-3 flex-shrink-0 h-5 w-5"></i>
            Dashboard
        </a>

        <a href="/pos" class="{{ request()->routeIs('pos.index') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="shopping-cart" class="{{ request()->routeIs('pos.index') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }} mr-3 flex-shrink-0 h-5 w-5"></i>
            Point of Sale
        </a>

        @if(auth()->check() && auth()->user()->role === 'admin')
        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Management</p>

        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') || request()->is('inventory*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="package" class="{{ request()->routeIs('products.*') || request()->is('inventory*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }} mr-3 flex-shrink-0 h-5 w-5"></i>
            Inventory
        </a>

        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="users" class="{{ request()->routeIs('users.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }} mr-3 flex-shrink-0 h-5 w-5"></i>
            Users
        </a>
        
        <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="bar-chart-3" class="{{ request()->routeIs('reports.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }} mr-3 flex-shrink-0 h-5 w-5"></i>
            Reports
        </a>
        @endif
    </nav>

    <!-- User Section -->
    <div class="p-4 border-t border-slate-200">
        <a href="#" class="flex items-center w-full px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-50 hover:text-slate-900 transition-colors">
            <img class="w-8 h-8 rounded-full bg-slate-200 mr-3 object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=eff6ff&color=1e40af" alt="User avatar">
            <div class="flex-1 truncate">
                <p class="text-sm font-medium text-slate-900 truncate">{{ auth()->user()->name ?? 'Guest' }}</p>
                <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email ?? '' }}</p>
            </div>
        </a>
    </div>
</aside>
