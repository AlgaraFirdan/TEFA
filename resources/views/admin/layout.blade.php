<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'TEFA') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pplg.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white relative">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-400">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.index') ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.preview') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.preview') ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                    Preview Tampilan
                </a>
                <a href="{{ route('admin.guru.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.guru.*') ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                    Guru
                </a>
                <a href="{{ route('admin.ruangan.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.ruangan.*') ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                    Ruangan
                </a>
                <a href="{{ route('admin.mapel.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.mapel.*') ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                    Mata Pelajaran
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.jadwal.*') ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                    Jadwal
                </a>
                <hr class="my-4 border-gray-600">
                <a href="{{ route('information-lab.index') }}" class="block px-6 py-3 hover:bg-gray-700 text-gray-400 hover:text-gray-300">
                    ← Information Lab
                </a>
                <form method="POST" action="{{ route('logout') }}" class="px-6 py-3">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-400 hover:text-red-300">
                        Logout
                    </button>
                </form>
            </nav>
            
            <!-- User Info -->
            <div class="absolute bottom-0 left-0 w-64 p-4 border-t border-gray-700">
                <div class="text-sm text-gray-400">Login sebagai:</div>
                <div class="text-white font-medium">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-700">@yield('title', 'Dashboard')</h2>
                    <div class="text-sm text-gray-500">
                        {{ now()->format('l, d F Y') }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t px-6 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'TEFA') }}. All rights reserved.
            </footer>
        </div>
    </div>
</body>
</html>