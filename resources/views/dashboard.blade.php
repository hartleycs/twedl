{{-- Dashboard --}}
<x-layouts.app>
  <flux:main>
    <h1 class="text-4xl font-bold mb-4">Welcome to Twedl</h1>
    <p class="text-lg text-gray-700 mb-6">
      This is your dashboard. In the future, this will show your submitted events, favourites, and more.
    </p>

    @auth
      <div class="space-y-2">
        <a href="{{ route('events.index') }}"
           class="text-sm text-blue-600 hover:underline">
          View My Submitted Events
        </a>
        <a href="{{ route('events.create') }}"
           class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
          Submit an Event
        </a>
      </div>
    @endauth

    <div class="mt-8">
      <p>You are logged in as <strong>{{ auth()->user()->name }}</strong>.</p>
    </div>
  </flux:main>
</x-layouts.app>
