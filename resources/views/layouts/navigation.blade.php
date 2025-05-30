<nav x-data="{ open: false }" class="bg-white dark:bg-neutral-dark-card border-b border-gray-200 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="logo-text">
                        Twedl
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-3 sm:-my-px sm:ml-10 sm:flex">
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
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="login-button">
                        Dashboard
                    </a>
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button @click="open = ! open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </div>

                        <div x-show="open" @click.away="open = false" class="user-dropdown origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-neutral-dark-card ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                            <a href="{{ route('settings.profile') }}" class="dropdown-item">
                                {{ __('Settings') }}
                            </a>
                            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="dropdown-item">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="login-button">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="signup-button">
                        Sign Up
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
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

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('settings.profile') }}" class="dropdown-item block px-4 py-2">
                        {{ __('Settings') }}
                    </a>
                    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item block w-full px-4 py-2">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
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
</nav>
