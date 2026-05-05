<x-app-layout>
    <x-slot name="title">Edit User</x-slot>

    <div class="mb-6">
        <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 transition-colors mb-4 text-sm font-medium">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Users
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Edit User: {{ $user->name }}</h1>
        <p class="text-slate-500 mt-1">Update staff account details.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-3xl">
        <form action="{{ route('users.update', $user) }}" method="POST" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Name -->
                <div class="col-span-1 md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border transition duration-150 ease-in-out">
                    @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border transition duration-150 ease-in-out">
                    @error('email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                    <select name="role" id="role" required
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border transition duration-150 ease-in-out bg-white">
                        <option value="cashier" {{ old('role', $user->role) == 'cashier' ? 'selected' : '' }}>Cashier</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="col-span-1 md:col-span-2">
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password (Leave blank to keep current)</label>
                    <input type="password" name="password" id="password" minlength="8"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border transition duration-150 ease-in-out">
                    @error('password') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end pt-5 border-t border-slate-100">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2.5 rounded-lg hover:bg-blue-600 transition-colors shadow-sm font-medium flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Update User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
