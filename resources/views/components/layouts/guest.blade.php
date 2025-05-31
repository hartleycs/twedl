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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
<body class="min-h-screen bg-pattern text-text-primary dark:text-text-dark antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-neutral-dark-card shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}">
                                <x-app-logo class="block h-8 w-auto" />
                            </a>
                        </div>
                        <nav class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            @auth
                            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                My Events
                            </a>
                            <a href="{{ route('events.create') }}" class="{{ request()->routeIs('events.create') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Create Event
                            </a>
                            @else
                            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Home
                            </a>
                            <a href="#features" class="border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Features
                            </a>
                            <a href="#how-it-works" class="border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                How It Works
                            </a>
                            @endauth
                        </nav>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        @auth
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
                        @else
                        <div class="flex space-x-4">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Register
                            </a>
                        </div>
                        @endauth
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
                    @auth
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        My Events
                    </a>
                    <a href="{{ route('events.create') }}" class="{{ request()->routeIs('events.create') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Create Event
                    </a>
                    @else
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Home
                    </a>
                    <a href="#features" class="border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Features
                    </a>
                    <a href="#how-it-works" class="border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        How It Works
                    </a>
                    @endauth
                </div>
                @auth
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
                @else
                <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col space-y-2 px-4">
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                            Register
                        </a>
                    </div>
                </div>
                @endauth
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-neutral-dark-card border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-text-secondary dark:text-text-dark-secondary">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                fetch('/settings/appearance/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ darkMode: false })
                });
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                fetch('/settings/appearance/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ darkMode: true })
                });
            }
        }
        
        // On page load, set the theme based on localStorage or system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>
</html>
