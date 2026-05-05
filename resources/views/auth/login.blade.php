<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Rico</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-500 mb-4 shadow-sm">
                <i data-lucide="store" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">POS Rico</h1>
            <p class="text-sm text-gray-500 mt-1">Sign in to your account</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8">
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-500 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                            placeholder="admin@pos.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Sign In
                </button>
            </form>
        </div>

        <div class="mt-6 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} POS Rico. All rights reserved.
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
