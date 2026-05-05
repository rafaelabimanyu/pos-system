<header class="h-16 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-4 md:px-6 z-10 transition-colors duration-300">
    
    <div class="flex items-center">
        <!-- Mobile menu button -->
        <button @click="sidebarOpen = true" type="button" class="lg:hidden text-slate-500 dark:text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 focus:outline-none focus:ring-2 focus:ring-brand rounded-lg p-1 mr-4 transition-colors">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
        
        <!-- Header Title (Dynamic based on slot/page or just search) -->
        <div class="hidden sm:block">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="search" class="h-4 w-4 text-slate-400 dark:text-slate-500"></i>
                </div>
                <input type="text" placeholder="Search across app..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg leading-5 bg-slate-50 dark:bg-slate-900 placeholder-slate-400 dark:placeholder-slate-500 text-slate-900 dark:text-slate-100 focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-300">
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <!-- Dark Mode Toggle -->
        <button id="theme-toggle" class="p-2 text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-colors rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none">
            <i data-lucide="moon" id="theme-toggle-dark-icon" class="w-5 h-5 hidden"></i>
            <i data-lucide="sun" id="theme-toggle-light-icon" class="w-5 h-5 hidden"></i>
        </button>

        <!-- Live Clock -->
        <div class="hidden md:flex items-center text-sm font-medium text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-900/50 px-3 py-1.5 rounded-lg border border-slate-100 dark:border-slate-800 transition-colors duration-300">
            <i data-lucide="clock" class="w-4 h-4 mr-2 text-blue-500 dark:text-blue-400"></i>
            <span id="live-clock">{{ now()->format('d M Y, H:i') }}</span>
        </div>

        <!-- Notifications -->
        <button class="relative p-2 text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-300 transition-colors rounded-full hover:bg-slate-50 dark:hover:bg-slate-700">
            <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-800 transition-colors duration-300"></span>
            <i data-lucide="bell" class="w-5 h-5"></i>
        </button>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="ml-2 m-0">
            @csrf
            <button type="submit" class="p-2 text-slate-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 transition-colors rounded-full hover:bg-red-50 dark:hover:bg-red-900/30" title="Logout">
                <i data-lucide="log-out" class="w-5 h-5"></i>
            </button>
        </form>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    });
</script>
