<x-layouts.app>
  <div class="max-w-4xl mx-auto py-10">
    <h1 class="text-xl font-bold mb-6">Moderate Events</h1>

    @if ($pendingEvents->count())
      <table class="w-full border">
        <thead class="bg-gray-100 text-sm text-left text-gray-600">
          <tr>
            <th class="px-4 py-2">Event</th>
            <th class="px-4 py-2">Submitted By</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pendingEvents as $event)
            <tr class="border-t">
              <td class="px-4 py-2">{{ $event->name }}</td>
              <td class="px-4 py-2">{{ $event->user->name }}</td>
                <td class="px-4 py-2">
                <a href="{{ route('admin.events.show', $event) }}" class="text-blue-600 hover:underline">View</a>

                <form action="{{ route('admin.events.approve', $event) }}" method="POST" class="inline ml-2">
                    @csrf
                    <button class="text-green-600 hover:underline">Approve</button>
                </form>

                <form action="{{ route('admin.events.reject', $event) }}" method="POST" class="inline ml-2">
                    @csrf
                    <button class="text-red-600 hover:underline">Reject</button>
                </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="text-gray-500">No pending events to moderate.</p>
    @endif
  </div>
</x-layouts.app>
