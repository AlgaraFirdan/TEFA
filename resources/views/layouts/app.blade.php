<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div id="app">
        <!-- Navigation Bar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <h1 class="text-2xl font-bold text-blue-600">{{ config('app.name', 'TEFA') }}</h1>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ route('information-lab.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Information Lab</a>
                    <a href="{{ route('admin.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Admin</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="min-h-screen">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center py-4 mt-12">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'TEFA') }}. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>