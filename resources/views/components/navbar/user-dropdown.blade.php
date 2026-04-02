<div class="relative ml-3" x-data="{
        open: false,
        theme: localStorage.theme || 'system',
        init() {
            this.$watch('theme', val => this.applyTheme(val));
            this.applyTheme(this.theme);
        },
        setTheme(val) {
            this.theme = val;
            localStorage.theme = val;
            this.applyTheme(val);
        },
        applyTheme(val) {
            if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }">
    <div>
        <button @click="open = !open" @click.away="open = false" type="button"
            class="flex items-center gap-x-3 rounded-full bg-gray-100 dark:bg-gray-900 px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
            id="user-menu-button" aria-expanded="false" aria-haspopup="true">

            <div
                class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>

            <span class="text-sm font-medium text-gray-700 dark:text-gray-200 hidden sm:block">
                {{ Auth::user()->name }}
            </span>

            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50 divide-y divide-gray-100 dark:divide-gray-700"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="display: none;">

        <div class="px-4 py-3">
            <p class="text-sm text-gray-900 dark:text-white font-medium truncate">
                {{ Auth::user()->name }}
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                {{ Auth::user()->email }}
            </p>
        </div>

        <div class="px-2 py-2">
            <div class="flex items-center justify-between p-1 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <button @click="setTheme('light')"
                    :class="{ 'bg-white dark:bg-gray-600 shadow-sm text-gray-900 dark:text-white': theme === 'light', 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': theme !== 'light' }"
                    class="flex-1 p-1.5 rounded-md flex justify-center transition-all duration-200" title="Light">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </button>
                <button @click="setTheme('dark')"
                    :class="{ 'bg-white dark:bg-gray-600 shadow-sm text-gray-900 dark:text-white': theme === 'dark', 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': theme !== 'dark' }"
                    class="flex-1 p-1.5 rounded-md flex justify-center transition-all duration-200" title="Dark">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                </button>
                <button @click="setTheme('system')"
                    :class="{ 'bg-white dark:bg-gray-600 shadow-sm text-gray-900 dark:text-white': theme === 'system', 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': theme !== 'system' }"
                    class="flex-1 p-1.5 rounded-md flex justify-center transition-all duration-200" title="System">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="py-1">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600"
                role="menuitem" tabindex="-1" id="user-menu-item-0">
                Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600"
                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>