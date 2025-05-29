<x-layouts.app>
  <div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold mb-4">{{ $event->name }}</h1>

    <p><strong>Submitted By:</strong> {{ $event->user->name }} ({{ $event->user->email }})</p>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Start:</strong> {{ $event->start_datetime->format('j M Y, H:i') }}</p>
    <p><strong>End:</strong> {{ $event->end_datetime->format('j M Y, H:i') }}</p>
    <p><strong>Venue:</strong> {{ $event->venue_name }}</p>
    <p><strong>Address:</strong> {{ $event->address_line_1 }}, {{ $event->city }}, {{ $event->country }}</p>
    <p><strong>Visibility:</strong> {{ ucfirst($event->visibility) }}</p>
    <p><strong>Status:</strong> {{ $event->status }}</p>

    <div class="mt-6 flex gap-4">
      <form action="{{ route('admin.events.approve', $event) }}" method="POST">
        @csrf
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Approve</button>
      </form>

      <form action="{{ route('admin.events.reject', $event) }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Reject</button>
      </form>
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.events.moderate') }}" class="text-blue-500 underline">Back to moderation list</a>
    </div>
  </div>
</x-layouts.app>
