<div class="bg-gray-50 dark:bg-gray-900 min-h-screen font-sans transition-colors duration-300">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <div
                class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 to-purple-600/20 dark:from-indigo-900/40 dark:to-purple-900/40">
            </div>
            <div
                class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-gray-50 dark:from-gray-900 to-transparent">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 sm:pb-32">
            <div class="text-center">
                <h1
                    class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                    <span class="block">{{ __('portfolio.hero.title_line1') }}</span>
                    <span
                        class="block text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">{{ __('portfolio.hero.title_line2') }}</span>
                </h1>
                <p
                    class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    {{ __('portfolio.hero.description') }}
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="{{ route('quote.form') }}"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg transition-all duration-200 transform hover:scale-105">
                            {{ __('portfolio.hero.get_quote') }}
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#portfolio"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-indigo-400 dark:hover:bg-gray-700 md:py-4 md:text-lg transition-all duration-200">
                            {{ __('portfolio.hero.view_work') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-y border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-5 sm:grid-cols-4 text-center">
                <div
                    class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-300">
                        {{ __('portfolio.stats.projects') }}
                    </dt>
                    <dd class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">
                        {{ $items->count() }}+
                    </dd>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-300">
                        {{ __('portfolio.stats.clients') }}
                    </dt>
                    <dd class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">10+</dd>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-300">
                        {{ __('portfolio.stats.experience') }}
                    </dt>
                    <dd class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">
                        {{ __('portfolio.stats.experience_years') }}
                    </dd>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 dark:text-gray-300">
                        {{ __('portfolio.stats.support') }}
                    </dt>
                    <dd class="order-1 text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">24/7</dd>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Section -->
    <div id="portfolio" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                {{ __('portfolio.portfolio.title') }}
            </h2>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-300 mx-auto">
                {{ __('portfolio.portfolio.subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($items as $item)
                <div
                    class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                        @if($item->hasMedia('images'))
                            <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}"
                                class="object-cover w-full h-48 group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div
                                class="flex items-center justify-center h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 text-gray-400 dark:text-gray-500">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $item->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3 text-sm">
                            {{ Str::limit(strip_tags($item->content), 100) }}
                        </p>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                            @if($item->live_url)
                                <a href="{{ $item->live_url }}" target="_blank"
                                    class="inline-flex items-center text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                                    {{ __('portfolio.portfolio.live_demo') }}
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                            @if($item->repo_url)
                                <a href="{{ $item->repo_url }}" target="_blank"
                                    class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    <svg class="mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('portfolio.portfolio.code') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900 mb-4">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ __('portfolio.portfolio.empty_title') }}</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">{{ __('portfolio.portfolio.empty_message') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-700 dark:bg-indigo-900">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">{{ __('portfolio.cta.title_line1') }}</span>
                <span class="block">{{ __('portfolio.cta.title_line2') }}</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">
                {{ __('portfolio.cta.description') }}
            </p>
            <a href="{{ route('quote.form') }}"
                class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto transition-colors duration-200">
                {{ __('portfolio.cta.button') }}
            </a>
        </div>
    </div>
</div>