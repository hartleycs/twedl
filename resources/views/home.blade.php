{{-- resources/views/home.blade.php --}}
<x-layouts.guest>
  <flux:main>
    <div class="max-w-6xl mx-auto py-12 px-6">
      {{-- Hero --}}
      <h1 class="text-4xl font-bold mb-4">Welcome to Twedl</h1>
      <p class="text-lg text-gray-700 mb-6">
        Discover and share events happening around the world.
      </p>

      {{-- Auth Links --}}
      @auth
        <a href="{{ route('dashboard') }}"
           class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black mb-6">
          Go to your Dashboard
        </a>
      @else
        <div class="space-x-4 mb-6">
          <a href="{{ route('login') }}"
             class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
            Login
          </a>
          <a href="{{ route('register') }}"
             class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
            Register
          </a>
        </div>
      @endauth

      {{-- Search / Filter --}}
      <form method="GET" action="{{ url('/') }}"
            class="mb-8 grid grid-cols-1 sm:grid-cols-4 gap-4">
        <input type="text" name="city" value="{{ request('city') }}"
               placeholder="City" class="border rounded px-3 py-2">
        <select name="event_type" class="border rounded px-3 py-2">
          <option value="">All Types</option>
          @foreach($eventTypes as $etype)
            <option value="{{ $etype }}"
                    {{ request('event_type') == $etype ? 'selected' : '' }}>
              {{ ucfirst($etype) }}
            </option>
          @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}"
               class="border rounded px-3 py-2">
        <input type="date" name="date_to" value="{{ request('date_to') }}"
               class="border rounded px-3 py-2">
        <button type="submit"
                class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black col-span-full sm:col-auto">
          Search
        </button>
      </form>

      {{-- Event Grid --}}
      @if($events->isEmpty())
        <p>No events found.</p>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($events as $event)
            <div class="border rounded overflow-hidden shadow-sm">
              @if($event->image_path)
                <img src="{{ asset('storage/'.$event->image_path) }}"
                     alt="{{ $event->name }}"
                     class="h-48 w-full object-cover">
              @endif
              <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>
                <p class="text-sm text-gray-600 mb-2">
                  {{ $event->start_datetime->format('d M Y, H:i') }}
                </p>
                <p class="text-sm mb-4">
                  {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                </p>
                {{-- If you add a public show route, swap "#" for route('public.events.show', $event) --}}
                <a href="#"
                   class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
                  View Details
                </a>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-8">
          {{ $events->links() }}
        </div>
      @endif
    </div>
  </flux:main>
</x-layouts.guest>
