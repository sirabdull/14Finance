<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard - 14Finance' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50">
    {{-- Navigation --}}
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <h1 class="text-2xl font-bold">14Finance</h1>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm bg-blue-800 hover:bg-blue-700 px-4 py-2 rounded transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Success Message --}}
    @if(session()->has('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 animate-slide-up">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-400 text-green-800 px-6 py-4 rounded-xl shadow-lg font-semibold flex items-center gap-3"
                role="alert">
                <span class="text-2xl">✓</span>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-gray-600">
                © 2026 14Finance | Group 14 Banking Platform | All Rights Reserved
            </p>
        </div>
    </footer>

    @livewireScripts
</body>

</html>
