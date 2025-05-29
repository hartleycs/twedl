<x-layouts.app>
  <flux:main>
    <h1 class="text-2xl font-bold mb-6">New Event Type</h1>

    <form method="POST" action="{{ route('admin.event-types.store') }}">
      @csrf

      <div class="mb-4">
        <label class="block font-semibold mb-1">Name</label>
        <input
          type="text"
          name="name"
          value="{{ old('name') }}"
          class="w-full border rounded px-3 py-2"
          required
        >
      </div>

      <button type="submit"
              class="bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
        Save Type
      </button>
    </form>
  </flux:main>
</x-layouts.app>
