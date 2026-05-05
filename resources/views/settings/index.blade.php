<x-app-layout>
    <x-slot name="title">System Settings</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white transition-colors duration-300">System Settings</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 transition-colors duration-300">Configure global application data and branding.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-4 rounded-xl border border-green-100 dark:border-green-800 flex items-center gap-3 transition-colors duration-300">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors duration-300">
        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Branding Section -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2 mb-4 transition-colors duration-300">Branding</h3>
                        
                        <div class="mb-4">
                            <label for="app_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Application Name</label>
                            <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $settings['app_name'] ?? 'POS Carolina') }}" 
                                class="block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-3 border transition duration-300 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="app_logo" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Application Logo (Optional)</label>
                            @if(isset($settings['app_logo']))
                                <div class="mb-3">
                                    <img src="{{ Storage::url($settings['app_logo']) }}" alt="App Logo" class="h-16 rounded-lg object-contain bg-slate-50 dark:bg-slate-800 p-2">
                                </div>
                            @endif
                            <input type="file" name="app_logo" id="app_logo" accept="image/*"
                                class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-400 dark:hover:file:bg-blue-900/50 transition duration-300">
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2 mb-4 transition-colors duration-300">Contact Information</h3>
                        
                        <div class="mb-4">
                            <label for="app_phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Business Phone</label>
                            <input type="text" name="app_phone" id="app_phone" value="{{ old('app_phone', $settings['app_phone'] ?? '') }}" 
                                class="block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-3 border transition duration-300 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="app_address" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Business Address</label>
                            <textarea name="app_address" id="app_address" rows="3"
                                class="block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-3 border transition duration-300 ease-in-out">{{ old('app_address', $settings['app_address'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100 dark:border-slate-800 transition-colors duration-300">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all font-bold flex items-center gap-2">
                    <i data-lucide="save" class="w-5 h-5"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
