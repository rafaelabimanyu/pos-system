<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-6 z-10">
    
    <div class="flex items-center">
        <!-- Mobile menu button -->
        <button type="button" class="md:hidden text-slate-500 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg p-1 mr-4">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
        
        <!-- Header Title (Dynamic based on slot/page or just search) -->
        <div class="hidden sm:block">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="search" class="h-4 w-4 text-slate-400"></i>
                </div>
                <input type="text" placeholder="Search across app..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-colors">
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <!-- Live Clock -->
        <div class="hidden md:flex items-center text-sm font-medium text-slate-600 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
            <i data-lucide="clock" class="w-4 h-4 mr-2 text-primary-500"></i>
            <span id="live-clock">{{ now()->format('d M Y, H:i') }}</span>
        </div>

        <!-- Notifications -->
        <button class="relative p-2 text-slate-400 hover:text-slate-500 transition-colors rounded-full hover:bg-slate-50">
            <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
            <i data-lucide="bell" class="w-5 h-5"></i>
        </button>

        <!-- Logout -->
        <form method="POST" action="#" class="ml-2">
            @csrf
            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors rounded-full hover:bg-red-50" title="Logout">
                <i data-lucide="log-out" class="w-5 h-5"></i>
            </button>
        </form>
    </div>
</header>
