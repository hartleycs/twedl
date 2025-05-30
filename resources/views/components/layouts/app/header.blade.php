{{-- Updated header component with colorful navigation buttons --}}
<header class="bg-white dark:bg-neutral-dark-card shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold">
                        Twedl
                    </a>
                </div>
                <nav class="hidden sm:ml-6 sm:flex sm:space-x-3">
                    <a href="{{ url('/') }}" class="nav-button nav-button-home">
                        Home
                    </a>
                    <a href="{{ route('events.index') }}" class="nav-button nav-button-events">
                        Events
                    </a>
                    <a href="{{ route('events.create') }}" class="nav-button nav-button-create">
                        Create
                    </a>
                    <a href="#about" class="nav-button nav-button-about">
                        About
                    </a>
                </nav>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-3">
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
                <div class="flex space-x-3">
                    <a href="{{ route('login') }}" class="login-button">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="signup-button">
                        Sign Up
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
        <div class="pt-2 pb-3 space-y-2 px-4">
            <a href="{{ url('/') }}" class="block nav-button nav-button-home w-full text-center">
                Home
            </a>
            <a href="{{ route('events.index') }}" class="block nav-button nav-button-events w-full text-center">
                Events
            </a>
            <a href="{{ route('events.create') }}" class="block nav-button nav-button-create w-full text-center">
                Create
            </a>
            <a href="#about" class="block nav-button nav-button-about w-full text-center">
                About
            </a>
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
            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-base font-medium text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md">
                    Your Profile
                </a>
                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-base font-medium text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md">
                    Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-text-secondary dark:text-text-dark-secondary hover:text-text-primary dark:hover:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col space-y-2 px-4">
                <a href="{{ route('login') }}" class="login-button w-full text-center">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="signup-button w-full text-center">
                    Sign Up
                </a>
            </div>
        </div>
        @endauth
    </div>
</header>
