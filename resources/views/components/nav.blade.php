<nav class="bg-white border-b border-gray-200 dark:bg-zinc-900 dark:border-zinc-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="{{ url('/') }}" class="text-xl font-semibold text-blue-600 hover:text-blue-800">
                Twedl
            </a>

            <div class="flex space-x-4 items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600 dark:text-gray-300 dark:hover:text-red-400">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
