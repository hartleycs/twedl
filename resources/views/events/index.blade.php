<x-layouts.app>
    <flux:main>
        <div class="max-w-5xl mx-auto py-12 px-6">
            <h1 class="text-2xl font-bold mb-6">My Submitted Events</h1>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($events->count())
                <table class="w-full border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-3 py-2 text-left">Image</th>
                            <th class="border px-3 py-2 text-left">Name</th>
                            <th class="border px-3 py-2">Start</th>
                            <th class="border px-3 py-2">Visibility</th>
                            <th class="border px-3 py-2">Status</th>
                            <th class="border px-3 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="border px-3 py-2 text-right space-x-2">
                                    <a href="{{ route('events.edit', $event) }}"
                                        class="inline-block text-sm text-blue-600 hover:underline">
                                            Edit
                                    </a>

                                    <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this event?')"
                                                class="text-sm text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td class="border px-3 py-2">{{ $event->name }}</td>
                                <td class="border px-3 py-2">{{ $event->start_datetime->format('d M Y, H:i') }}</td>
                                <td class="border px-3 py-2 capitalize">{{ $event->visibility }}</td>
                                <td class="border px-3 py-2">{{ $event->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No events submitted yet.</p>
            @endif
        </div>
    </flux:main>
</x-layouts.app>
