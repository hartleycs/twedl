@props(['event'])

<div class="bg-white dark:bg-neutral-dark-card rounded-card shadow-card hover:shadow-card-hover transition-all duration-fast transform hover:-translate-y-1 overflow-hidden">
    @if($event->image_path)
        <div class="relative h-48 overflow-hidden">
            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
            @if($event->is_free)
                <div class="absolute top-3 right-3 bg-status-success text-white text-xs font-semibold px-2 py-1 rounded-full">
                    {{ __('Free') }}
                </div>
            @endif
        </div>
    @else
        <div class="relative h-48 bg-gradient-to-r from-primary-light to-secondary-light dark:from-primary-light/20 dark:to-secondary-light/20 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary/50 dark:text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            @if($event->is_free)
                <div class="absolute top-3 right-3 bg-status-success text-white text-xs font-semibold px-2 py-1 rounded-full">
                    {{ __('Free') }}
                </div>
            @endif
        </div>
    @endif
    
    <div class="p-5">
        <div class="flex items-center mb-3">
            <div class="bg-primary-light dark:bg-primary-light/20 text-primary rounded-full px-3 py-1 text-xs font-medium">
                {{ $event->eventType->name }}
            </div>
            <div class="ml-2 text-text-light dark:text-text-dark-secondary text-sm">
                {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y') }}
            </div>
        </div>
        
        <h3 class="font-heading font-semibold text-xl mb-2 text-text-primary dark:text-text-dark">
            {{ $event->name }}
        </h3>
        
        <p class="text-text-secondary dark:text-text-dark-secondary text-sm mb-4 line-clamp-2">
            {{ Str::limit($event->description, 120) }}
        </p>
        
        <div class="flex items-center text-text-secondary dark:text-text-dark-secondary text-sm mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>{{ $event->city }}, {{ $event->country }}</span>
        </div>
        
        @if($event->tags->count() > 0)
            <div class="flex flex-wrap gap-1 mb-4">
                @foreach($event->tags->take(3) as $tag)
                    <span class="bg-secondary-light dark:bg-secondary-light/20 text-secondary text-xs px-2 py-1 rounded-full">
                        {{ $tag->name }}
                    </span>
                @endforeach
                @if($event->tags->count() > 3)
                    <span class="bg-gray-100 dark:bg-gray-700 text-text-secondary dark:text-text-dark-secondary text-xs px-2 py-1 rounded-full">
                        +{{ $event->tags->count() - 3 }}
                    </span>
                @endif
            </div>
        @endif
        
        <div class="flex justify-between items-center">
            <div class="text-sm font-medium">
                @if(!$event->is_free)
                    <span class="text-primary dark:text-primary-light">
                        {{ $event->currency }} {{ json_decode($event->ticket_prices)[0]->price ?? 'Paid' }}
                    </span>
                @else
                    <span class="text-status-success">
                        {{ __('Free Entry') }}
                    </span>
                @endif
            </div>
            
            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-fast">
                {{ __('View Details') }}
            </a>
        </div>
    </div>
</div>
