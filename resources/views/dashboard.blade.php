<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stat-card">
                    <span class="stat-value">12</span>
                    <span class="stat-label">Your Events</span>
                </div>
                <div class="stat-card">
                    <span class="stat-value">48</span>
                    <span class="stat-label">Attendees</span>
                </div>
                <div class="stat-card">
                    <span class="stat-value">5</span>
                    <span class="stat-label">Upcoming Events</span>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="dashboard-card mb-8">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('events.create') }}" class="btn-primary">
                        Create Event
                    </a>
                    <a href="{{ route('events.index') }}" class="btn-secondary">
                        Browse Events
                    </a>
                    <a href="{{ route('settings.profile') }}" class="btn-secondary">
                        Edit Profile
                    </a>
                </div>
            </div>
            
            <!-- Upcoming Events -->
            <div class="dashboard-card">
                <h3 class="text-lg font-semibold mb-4">Your Upcoming Events</h3>
                <div class="space-y-4">
                    <!-- Event Item -->
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium">Tech Conference 2025</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">June 15, 2025 • 10:00 AM</p>
                                <p class="text-sm mt-1">San Francisco Convention Center</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                    Confirmed
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Item -->
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium">Web Development Workshop</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">June 22, 2025 • 2:00 PM</p>
                                <p class="text-sm mt-1">Online</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                    Planning
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Item -->
                    <div class="pb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium">AI Meetup Group</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">July 5, 2025 • 6:30 PM</p>
                                <p class="text-sm mt-1">Downtown Tech Hub</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                    Pending
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="#" class="text-sm text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-primary transition">
                            View all events →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
