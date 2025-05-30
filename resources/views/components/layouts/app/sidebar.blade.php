<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('darkMode', false) ? 'dark' : '' }}">
<head>
    @include('partials.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="min-h-screen bg-white dark:bg-neutral-dark-bg text-text-primary dark:text-text-dark">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-normal ease-in-out bg-neutral-card dark:bg-neutral-dark-card border-r border-gray-200 dark:border-gray-700 lg:translate-x-0 lg:static lg:inset-0 {{ request( )->routeIs('dashboard') ? '' : '-translate-x-full' }} lg:translate-x-0">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200 dark:border-gray-700">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                        <x-app-logo class="w-8 h-8" />
                        <span class="text-xl font-bold text-primary">Twedl</span>
                    </a>
                    <button class="p-2 rounded-md lg:hidden hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none" id="closeSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-5 space-y-6 overflow-y-auto">
                    <div>
                        <h3 class="text-xs font-semibold text-text-light dark:text-text-dark-secondary uppercase tracking-wider">
                            {{ __('Platform' ) }}
                        </h3>
                        <ul class="mt-3 space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" 
                                   class="sidebar-item-enhanced {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                   wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Dashboard' ) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('events.index') }}" 
                                   class="sidebar-item-enhanced {{ request()->routeIs('events.*') && !request()->routeIs('events.create') ? 'active' : '' }}"
                                   wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ __('My Events' ) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('events.create') }}" 
                                   class="sidebar-item-enhanced {{ request()->routeIs('events.create') ? 'active' : '' }}"
                                   wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    {{ __('Create Event' ) }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if(auth()->user()?->is_admin)
                    <div>
                        <h3 class="text-xs font-semibold text-text-light dark:text-text-dark-secondary uppercase tracking-wider">
                            {{ __('Admin Tools') }}
                        </h3>
                        <ul class="mt-3 space-y-1">
                            <li>
                                <a href="{{ route('admin.events.pending') }}" 
                                   class="sidebar-item-enhanced {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"
                                   wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    {{ __('Pending Events') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </nav>

                <!-- User Menu -->
                @auth
                <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-primary-light dark:bg-primary-light/20 flex items-center justify-center text-primary font-medium">
                                {{ auth()->user()->initials() }}
                            </div>
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            <div class="text-sm font-medium text-text-primary dark:text-text-dark truncate">
                                {{ auth()->user()->name }}
                            </div>
                            <div class="text-xs text-text-secondary dark:text-text-dark-secondary truncate">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-1 rounded-full text-text-secondary dark:text-text-dark-secondary hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-neutral-dark-card ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700">
                                <div class="py-1">
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800" wire:navigate>
                                        {{ __('Settings') }}
                                    </a>
                                </div>
                                <div class="py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-white dark:bg-neutral-dark-bg border-b border-gray-200 dark:border-gray-700 sticky top-0 z-40">
                <div class="flex items-center justify-between px-4 py-3">
                    <button class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none" id="openSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <a href="{{ route('dashboard' ) }}" class="flex items-center" wire:navigate>
                        <x-app-logo class="w-8 h-8" />
                        <span class="ml-2 text-xl font-bold text-primary">Twedl</span>
                    </a>
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-sm focus:outline-none">
                            <div class="h-8 w-8 rounded-full bg-primary-light dark:bg-primary-light/20 flex items-center justify-center text-primary font-medium">
                                {{ auth()->user()->initials() }}
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-neutral-dark-card ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700">
                            <div class="py-1">
                                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800" wire:navigate>
                                    {{ __('Settings') }}
                                </a>
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="flex space-x-2">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 font-medium rounded-md text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-3 py-1 text-sm border border-transparent font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                            {{ __('Register') }}
                        </a>
                    </div>
                    @endauth
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-neutral-dark-bg/50 p-4 md:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Dark Mode Toggle -->
    <div class="fixed bottom-8 right-8 z-50">
        <button 
            class="p-3 rounded-full bg-primary text-white shadow-lg"
            onclick="toggleDarkMode()"
            aria-label="Toggle dark mode"
        >
            <svg id="dark-icon" class="hidden dark:block" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
            </svg>
            <svg id="light-icon" class="block dark:hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
            </svg>
        </button>
    </div>

    <!-- Scripts -->
    @fluxScripts
    @stack('scripts' )
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function ( ) {
            // Select2 initialization
            const select = document.getElementById('tags');
            if (select) {
                $(select).select2({
                    placeholder: 'Select or type tags',
                    tags: true,
                    tokenSeparators: [',']
                });
            }

            // Mobile sidebar toggle
            const openSidebarBtn = document.getElementById('openSidebar');
            const closeSidebarBtn = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('aside');

            if (openSidebarBtn && closeSidebarBtn && sidebar) {
                openSidebarBtn.addEventListener('click', function() {
                    sidebar.classList.remove('-translate-x-full');
                });

                closeSidebarBtn.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                });
            }
        });

        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
                // Server-side route call removed
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
                // Server-side route call removed
            }
        }

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else if (localStorage.getItem('darkMode') === 'false') {
            document.documentElement.classList.remove('dark');
        }

    </script>
</body>
</html>
