<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 selection:bg-indigo-500 selection:text-white">
        <!-- Background Decorations -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-indigo-400/10 blur-3xl"></div>
            <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-purple-400/10 blur-3xl"></div>
            <div class="absolute -bottom-[20%] left-[20%] w-[40%] h-[40%] rounded-full bg-pink-400/10 blur-3xl"></div>
        </div>

        <div
            class="z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl ring-1 ring-gray-900/5 dark:ring-white/10 sm:rounded-2xl transition-all duration-300 hover:shadow-indigo-500/20">
            <div class="flex justify-center mb-8">
                <a href="/" wire:navigate class="transform transition-transform duration-300 hover:scale-110">
                    <x-application-logo class="w-20 h-20 fill-current text-indigo-600 dark:text-indigo-400" />
                </a>
            </div>

            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>