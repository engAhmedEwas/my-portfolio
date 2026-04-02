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
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    @livewireStyles
    <script>
        if (
            localStorage.theme === 'dark' ||
            ((!('theme' in localStorage) || localStorage.theme === 'system') && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Simple Navigation -->
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 relative z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="font-bold text-xl text-gray-900 dark:text-gray-100">
                            Portfolio
                        </a>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="/"
                                class="text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 px-3 py-2">Portfolio</a>
                            <a href="/book"
                                class="text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 px-3 py-2">Book</a>
                            <a href="/quote"
                                class="text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 px-3 py-2">Quote</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <x-navbar.user-dropdown />
                        @else
                            <a href="/login"
                                class="text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 font-medium">Login</a>
                            <a href="/register"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 font-medium transition-colors">Register</a>
                        @endauth
                        <x-language-switcher />
                    </div>
                </div>
            </div>
        </nav>


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @livewireScripts
    </div>
</body>

</html>