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
<body class="antialiased bg-gray-50 dark:bg-neutral-dark-bg text-text-primary dark:text-text-dark">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-neutral-dark-card shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-app-logo class="block h-8 w-auto" />
                            </a>
                        </div>
                        <nav class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Home
                            </a>
                            <a href="#features" class="border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Features
                            </a>
                            <a href="#how-it-works" class="border-transparent text-text-secondary hover:border-gray-300 hover:text-text-primary inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                How It Works
                            </a>
                        </nav>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Register
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
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-primary-light dark:bg-primary-light/20 border-primary text-primary' : 'border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Home
                    </a>
                    <a href="#features" class="border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Features
                    </a>
                    <a href="#how-it-works" class="border-transparent text-text-secondary hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 hover:text-text-primary block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        How It Works
                    </a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150 mx-4">
                            Dashboard
                        </a>
                    @else
                        <div class="flex flex-col space-y-2 px-4">
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 dark:from-primary/5 dark:to-secondary/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div class="hero-animation">
                        <h1 class="text-4xl md:text-5xl font-heading font-bold text-text-primary dark:text-text-dark leading-tight">
                            Discover Amazing Events Near You
                        </h1>
                        <p class="mt-4 text-xl text-text-secondary dark:text-text-dark-secondary">
                            Find and join exciting events in your area or create your own to connect with like-minded people.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Get Started
                            </a>
                            <a href="#how-it-works" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" alt="Event" class="rounded-lg shadow-xl">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-16 bg-white dark:bg-neutral-dark-card">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-heading font-bold text-text-primary dark:text-text-dark">
                        Why Choose Twedl?
                    </h2>
                    <p class="mt-4 text-xl text-text-secondary dark:text-text-dark-secondary max-w-3xl mx-auto">
                        Our platform makes it easy to discover, create, and manage events of all types.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="feature-card bg-neutral-card dark:bg-neutral-dark-bg rounded-lg p-6 shadow-md">
                        <div class="h-12 w-12 bg-primary-light dark:bg-primary-light/20 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Easy Discovery
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Find events based on location, interests, or recommendations tailored just for you.
                        </p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="feature-card bg-neutral-card dark:bg-neutral-dark-bg rounded-lg p-6 shadow-md">
                        <div class="h-12 w-12 bg-primary-light dark:bg-primary-light/20 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Simple Creation
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Create and manage your events with our intuitive tools and customization options.
                        </p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="feature-card bg-neutral-card dark:bg-neutral-dark-bg rounded-lg p-6 shadow-md">
                        <div class="h-12 w-12 bg-primary-light dark:bg-primary-light/20 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Community Building
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Connect with attendees, gather feedback, and grow your community with every event.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-16 bg-gray-50 dark:bg-neutral-dark-bg/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-heading font-bold text-text-primary dark:text-text-dark">
                        How It Works
                    </h2>
                    <p class="mt-4 text-xl text-text-secondary dark:text-text-dark-secondary max-w-3xl mx-auto">
                        Getting started with Twedl is easy. Follow these simple steps:
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="h-16 w-16 bg-primary-light dark:bg-primary-light/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-primary">1</span>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Create an Account
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Sign up for free and set up your profile in minutes.
                        </p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="h-16 w-16 bg-primary-light dark:bg-primary-light/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-primary">2</span>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Discover Events
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Browse events in your area or search by category and interests.
                        </p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="h-16 w-16 bg-primary-light dark:bg-primary-light/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-primary">3</span>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Create Your Event
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Set up your own event with all the details and customization options.
                        </p>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="text-center">
                        <div class="h-16 w-16 bg-primary-light dark:bg-primary-light/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-primary">4</span>
                        </div>
                        <h3 class="text-xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">
                            Connect & Enjoy
                        </h3>
                        <p class="text-text-secondary dark:text-text-dark-secondary">
                            Attend events, meet new people, and build your community.
                        </p>
                    </div>
                </div>
                
                <div class="mt-12 text-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                        Get Started Now
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-r from-primary to-secondary">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-heading font-bold text-white mb-4">
                    Ready to Discover Amazing Events?
                </h2>
                <p class="text-xl text-white/80 max-w-3xl mx-auto mb-8">
                    Join thousands of users who are already finding and creating events on Twedl.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-colors duration-150">
                        Sign Up Free
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-colors duration-150">
                        Log In
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
        <footer class="bg-white dark:bg-neutral-dark-card border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <x-app-logo class="h-8 w-auto" />
                            <span class="ml-2 text-xl font-bold text-primary">Twedl</span>
                        </a>
                        <p class="mt-4 text-text-secondary dark:text-text-dark-secondary">
                            Discover, create, and connect through events that matter to you.
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-text-primary dark:text-text-dark uppercase tracking-wider">
                            Company
                        </h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                                    Careers
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-text-primary dark:text-text-dark uppercase tracking-wider">
                            Legal
                        </h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                                    Terms of Service
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-text-secondary dark:text-text-dark-secondary hover:text-primary dark:hover:text-primary-light">
                                    Cookie Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-12 border-t border-gray-200 dark:border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-text-secondary dark:text-text-dark-secondary text-sm">
                        &copy; {{ date('Y') }} Twedl. All rights reserved.
                    </p>
                    <div class="mt-4 md:mt-0 flex space-x-6">
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
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
