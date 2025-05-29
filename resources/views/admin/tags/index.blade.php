<x-layouts.app>
  <div class="max-w-3xl mx-auto py-10">
    <h1 class="text-xl font-bold mb-6">Pending Tags</h1>

    @if ($tags->count())
      <form method="POST" action="{{ route('admin.tags.bulk') }}" id="tag-form">
        @csrf
        <input type="hidden" name="action" id="bulk-action" value="">

        <table class="w-full border">
          <thead class="bg-gray-100 text-sm text-left text-gray-600">
            <tr>
              <th class="px-4 py-2"><input type="checkbox" id="select-all"></th>
              <th class="px-4 py-2">Tag</th>
              <th class="px-4 py-2">Used</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tags as $tag)
              <tr class="border-t">
                <td class="px-4 py-2">
                  <input type="checkbox" name="selected_tags[]" value="{{ $tag->id }}" class="tag-checkbox">
                </td>
                <td class="px-4 py-2">{{ $tag->name }}</td>
                <td class="px-4 py-2">{{ $tag->events_count }}</td>
                <td class="px-4 py-2">
                  <form action="{{ route('admin.tags.approve', $tag) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-green-700 hover:underline">Approve</button>
                  </form>

                  <form action="{{ route('admin.tags.reject', $tag) }}" method="POST" class="inline ml-4">
                    @csrf
                    <button type="submit" class="text-red-700 hover:underline">Reject</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-4 flex gap-4">
          <button
            type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded"
            onclick="setBulkAction('approve')"
          >
            Approve Selected
          </button>

          <button
            type="submit"
            class="bg-red-500 text-white px-4 py-2 rounded"
            onclick="setBulkAction('reject')"
          >
            Reject Selected
          </button>
        </div>
      </form>
    @else
      <p class="text-gray-500">No pending tags found.</p>
    @endif
  </div>

  <script>
    document.getElementById('select-all')?.addEventListener('change', function () {
      document.querySelectorAll('.tag-checkbox').forEach(cb => cb.checked = this.checked);
    });

    function setBulkAction(action) {
      document.getElementById('bulk-action').value = action;
    }
  </script>
</x-layouts.app>
