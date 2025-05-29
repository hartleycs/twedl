@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ config('app.name', 'Twedl') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Additional Styles -->
    <style>
        /* Base styles for improved appearance */
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Custom animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 dark:bg-neutral-dark-bg text-text-primary dark:text-text-dark antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-neutral-dark-card shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}">
                                <x-app-logo class="block h-8 w-auto" />
                            </a>
                        </div>
                        <nav class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                My Events
                            </a>
                            <a href="{{ route('events.create') }}" class="{{ request()->routeIs('events.create') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Create Event
                            </a>
                        </nav>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="bg-white dark:bg-neutral-dark-card flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-primary-light dark:bg-primary-light/20 flex items-center justify-center text-primary font-medium">
                                        {{ auth()->user()->initials() }}
                                    </div>
                                </button>
                            </div>
                            <div x-show="open" 
                                 @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-100" 
                                 x-transition:enter-start="transform opacity-0 scale-95" 
                                 x-transition:enter-end="transform opacity-100 scale-100" 
                                 x-transition:leave="transition ease-in duration-75" 
                                 x-transition:leave-start="transform opacity-100 scale-100" 
                                 x-transition:leave-end="transform opacity-0 scale-95" 
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-neutral-dark-card ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                 role="menu" 
                                 aria-orientation="vertical" 
                                 aria-labelledby="user-menu-button" 
                                 tabindex="-1">
                                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                    Your Profile
                                </a>
                                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                    Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-text-primary dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex items-center sm:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false" x-data="{ open: false }" @click="open = !open">
                            <span class="sr-only">Open main menu</span>
                            <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu" x-data="{ open: false }" x-show="open">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        My Events
                    </a>
                    <a href="{{ route('events.create') }}" class="{{ request()->routeIs('events.create') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Create Event
                    </a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-primary-light dark:bg-primary-light/20 flex items-center justify-center text-primary font-medium">
                                {{ auth()->user()->initials() }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-text-primary dark:text-text-dark">{{ auth()->user()->name }}</div>
                            <div class="text-sm font-medium text-text-secondary dark:text-text-dark-secondary">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-base font-medium text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800">
                            Your Profile
                        </a>
                        <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-base font-medium text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800">
                            Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="fade-in">
                    {{ $slot }}
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white dark:bg-neutral-dark-card border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <x-app-logo class="h-8 w-auto" />
                        <p class="text-text-secondary dark:text-text-dark-secondary text-sm">
                            &copy; {{ date('Y') }} Twedl. All rights reserved.
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                            Terms
                        </a>
                        <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                            Privacy
                        </a>
                        <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
