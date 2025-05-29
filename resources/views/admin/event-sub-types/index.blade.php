<x-layouts.app>
  <flux:main>
    <h1 class="text-2xl font-bold mb-6">
      Sub-Types for “{{ $eventType->name }}”
    </h1>

    <a href="{{ route('admin.event-types.sub-types.create', $eventType) }}"
       class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black mb-4">
      + New Sub-Type
    </a>

    @if(session('success'))
      <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
        {{ session('success') }}
      </div>
    @endif

    <table class="w-full border-collapse border border-gray-300 text-sm">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-3 py-2 text-left">Name</th>
          <th class="border px-3 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subs as $sub)
          <tr>
            <td class="border px-3 py-2">{{ $sub->name }}</td>
            <td class="border px-3 py-2 space-x-2">
              <a href="{{ route('admin.sub-types.edit', $sub) }}"
                 class="text-blue-600 hover:underline">Edit</a>

              <form method="POST"
                    action="{{ route('admin.sub-types.destroy', $sub) }}"
                    class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:underline">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </flux:main>
</x-layouts.app>
