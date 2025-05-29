{{-- resources/views/invites/show.blade.php --}}
<x-layouts.guest>
    <div class="max-w-4xl mx-auto py-12 px-6">
        {{-- Notice for invitees --}}
        <p class="mb-6 italic text-gray-600">
            You’re viewing this private event via an invitation link.
        </p>

        {{-- Event Title --}}
        <h1 class="text-3xl font-bold mb-4">{{ $event->name }}</h1>

        {{-- Dates --}}
        <p class="text-gray-600 mb-2">
            {{ $event->start_datetime->format('d M Y, H:i') }}
            @if($event->end_datetime)
                – {{ $event->end_datetime->format('d M Y, H:i') }}
            @endif
        </p>

        {{-- Location --}}
        @if($event->location_address)
            <p class="mb-2">
                <strong>Location:</strong> {{ $event->location_address }}
            </p>
        @endif

        {{-- Website --}}
        @if($event->website_url)
            <p class="mb-4">
                <strong>Website:</strong>
                <a href="{{ $event->website_url }}"
                   class="text-yellow-300 hover:underline">
                    {{ $event->website_url }}
                </a>
            </p>
        @endif

        {{-- Description --}}
        <div class="prose mb-6">
            {!! nl2br(e($event->description)) !!}
        </div>

        {{-- Price / Free --}}
        <p class="mb-4">
            <strong>Price:</strong>
            @if($event->is_free)
                Free
            @else
                £{{ number_format($event->price, 2) }}
            @endif
        </p>

        {{-- Accessibility Info --}}
        @if($event->accessibility_info)
            <p class="mb-4">
                <strong>Accessibility:</strong> {{ $event->accessibility_info }}
            </p>
        @endif

        {{-- Tags --}}
        @if($event->tags)
            <p class="mb-4">
                <strong>Tags:</strong>
                @foreach(explode(',', $event->tags) as $tag)
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                        {{ trim($tag) }}
                    </span>
                @endforeach
            </p>
        @endif
    </div>
</x-layouts.guest>
