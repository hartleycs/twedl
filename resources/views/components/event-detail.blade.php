@props(['event'])

<div class="bg-white dark:bg-neutral-dark-card rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-2xl font-heading font-semibold text-text-primary dark:text-text-dark mb-2">{{ $event->name }}</h2>
                <div class="flex items-center text-sm text-text-secondary dark:text-text-dark-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y') }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_datetime)->format('g:i A') }}</span>
                </div>
            </div>
            <div class="flex space-x-2">
                @if($event->status === 'P')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-200">
                        {{ __('Pending') }}
                    </span>
                @elseif($event->status === 'A')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-200">
                        {{ __('Approved') }}
                    </span>
                @elseif($event->status === 'R')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-200">
                        {{ __('Rejected') }}
                    </span>
                @endif
                
                @if($event->is_free)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-success/20 text-status-success dark:bg-status-success/30 dark:text-green-200">
                        {{ __('Free') }}
                    </span>
                @endif
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="col-span-2">
                @if($event->image_path)
                    <div class="rounded-lg overflow-hidden h-64 mb-4">
                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="rounded-lg bg-gradient-to-r from-primary-light to-secondary-light dark:from-primary-light/20 dark:to-secondary-light/20 h-64 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-primary/50 dark:text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                
                <div class="prose dark:prose-invert max-w-none">
                    <h3 class="text-lg font-semibold text-text-primary dark:text-text-dark mb-2">{{ __('Description') }}</h3>
                    <p class="text-text-secondary dark:text-text-dark-secondary">{{ $event->description }}</p>
                </div>
                
                @if($event->tags->count() > 0)
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-text-primary dark:text-text-dark mb-2">{{ __('Tags') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($event->tags as $tag)
                                <span class="bg-secondary-light dark:bg-secondary-light/20 text-secondary text-xs px-3 py-1 rounded-full">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <div>
                <div class="bg-neutral-card dark:bg-neutral-dark-bg rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold text-text-primary dark:text-text-dark mb-3">{{ __('Event Details') }}</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="font-medium text-text-primary dark:text-text-dark">{{ __('Location') }}</p>
                                <p class="text-sm text-text-secondary dark:text-text-dark-secondary">
                                    {{ $event->venue_name }}<br>
                                    {{ $event->address_line_1 }}<br>
                                    @if($event->address_line_2)
                                        {{ $event->address_line_2 }}<br>
                                    @endif
                                    {{ $event->city }}, {{ $event->state }} {{ $event->postcode }}<br>
                                    {{ $event->country }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-medium text-text-primary dark:text-text-dark">{{ __('Date & Time') }}</p>
                                <p class="text-sm text-text-secondary dark:text-text-dark-secondary">
                                    {{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y') }}<br>
                                    {{ \Carbon\Carbon::parse($event->start_datetime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_datetime)->format('g:i A') }}
                                </p>
                            </div>
                        </div>
                        
                        @if(!$event->is_free)
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-medium text-text-primary dark:text-text-dark">{{ __('Pricing') }}</p>
                                    <div class="text-sm text-text-secondary dark:text-text-dark-secondary">
                                        @php
                                            $prices = json_decode($event->ticket_prices);
                                        @endphp
                                        @if(is_array($prices) && count($prices) > 0)
                                            @foreach($prices as $price)
                                                <p>{{ $price->label }}: {{ $event->currency }} {{ $price->price }}</p>
                                            @endforeach
                                        @else
                                            <p>{{ $event->currency }} {{ $prices[0]->price ?? 'Paid' }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if($event->website_url)
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <div>
                                    <p class="font-medium text-text-primary dark:text-text-dark">{{ __('Website') }}</p>
                                    <a href="{{ $event->website_url }}" target="_blank" class="text-sm text-primary hover:text-primary-hover dark:text-primary-light dark:hover:text-primary transition-colors duration-150">
                                        {{ $event->website_url }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if($event->booking_url)
                    <a href="{{ $event->booking_url }}" target="_blank" class="block w-full bg-primary hover:bg-primary-hover text-white font-medium py-3 px-4 rounded-md text-center transition-colors duration-150">
                        {{ __('Book Tickets') }}
                    </a>
                @endif
            </div>
        </div>
        
        <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-4">
            <div class="flex space-x-2">
                <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-text-primary dark:text-text-dark bg-white dark:bg-neutral-dark-card hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-text-secondary dark:text-text-dark-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    {{ __('Back to Events') }}
                </a>
            </div>
            
            @if(auth()->id() === $event->user_id)
                <div class="flex space-x-2">
                    <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        {{ __('Edit Event') }}
                    </a>
                    
                    <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-status-error hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150" onclick="return confirm('{{ __('Are you sure you want to delete this event?') }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
