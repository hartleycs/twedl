@props(['title' => 'Welcome to Twedl'])

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
    <link rel="stylesheet" href="{{ asset('css/ui-redesign.css') }}">
    
    <!-- Additional Styles -->
    <style>
        /* Base styles for improved appearance */
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Hero section animation */
        .hero-animation {
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Card hover effects */
        .feature-card {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="antialiased bg-pattern text-text-primary dark:text-text-dark">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
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
                            <a href="{{ route('dashboard') }}" class="login-button">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="login-button">
                                Log In
                            </a>
                            <a href="{{ route('register') }}" class="signup-button">
                                Sign Up
                            </a>
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
                <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center login-button mx-4 mb-2">
                            Dashboard
                        </a>
                    @else
                        <div class="flex flex-col space-y-2 px-4">
                            <a href="{{ route('login') }}" class="login-button w-full text-center">
                                Log In
                            </a>
                            <a href="{{ route('register') }}" class="signup-button w-full text-center">
                                Sign Up
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="bg-white dark:bg-neutral-dark-bg">
            <div class="max-w-7xl mx-auto hero-container">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div class="hero-animation">
                        <h1 class="hero-title">
                            Discover Amazing Events Near You
                        </h1>
                        <p class="hero-description">
                            Find and join exciting events in your area or create your own to connect with like-minded people.
                        </p>
                        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                            <a href="{{ route('register') }}" class="signup-button inline-flex items-center justify-center px-6 py-3">
                                Get Started
                            </a>
                            <a href="#how-it-works" class="login-button inline-flex items-center justify-center px-6 py-3">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="bg-gray-200 dark:bg-gray-700 rounded-lg p-8 text-center h-80 flex items-center justify-center">
                            <span class="text-gray-500 dark:text-gray-400 text-lg">Hero Image Placeholder</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-16 bg-white dark:bg-neutral-dark-card">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">
                        Why Choose Twedl?
                    </h2>
                    <p class="text-xl text-text-secondary dark:text-text-dark-secondary max-w-3xl mx-auto">
                        Our platform makes it easy to discover, create, and manage events of all types.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">
                            Easy Discovery
                        </h3>
                        <p class="feature-description">
                            Find events based on location, interests, or recommendations tailored just for you.
                        </p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="feature-title">
                            Simple Creation
                        </h3>
                        <p class="feature-description">
                            Create and manage your events with our intuitive tools and customization options.
                        </p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">
                            Community Building
                        </h3>
                        <p class="feature-description">
                            Connect with attendees, gather feedback, and grow your community with every event.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white dark:bg-neutral-dark-card border-t border-gray-200 dark:border-gray-700 mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Twedl</h3>
                        <p class="text-sm text-text-secondary dark:text-text-dark-secondary">
                            Discover, create, and join amazing events in your area.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">Home</a></li>
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">Events</a></li>
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">Create Event</a></li>
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">About Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">Help Center</a></li>
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">Contact Us</a></li>
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">FAQs</a></li>
                            <li><a href="#" class="text-sm text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Tech Conference 2025</h3>
                        <p class="text-sm text-text-secondary dark:text-text-dark-secondary">
                            Join us for the biggest tech conference of the year with speakers from around the world.
                        </p>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-text-secondary dark:text-text-dark-secondary text-center">
                        © 2025 Twedl. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Dark Mode Toggle -->
    <button 
        class="dark-mode-toggle"
        onclick="toggleDarkMode()"
        aria-label="Toggle dark mode"
    >
        <svg id="dark-icon" class="hidden dark:block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
        </svg>
        <svg id="light-icon" class="block dark:hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        </svg>
    </button>

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
