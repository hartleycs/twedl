<x-layouts.app>
  <div class="max-w-6xl mx-auto py-12 px-6">
    <h1 class="text-2xl font-bold mb-6">Admin Event Vetting</h1>

    @foreach (['success', 'error'] as $msg)
      @if (session($msg))
        <div class="mb-4 p-4 bg-{{ $msg=='success'?'green':'red' }}-100 border text-{{ $msg=='success'?'green':'red' }}-800 rounded">
          {{ session($msg) }}
        </div>
      @endif
    @endforeach

    @if($pendingEvents->isEmpty())
      <p>No events pending vetting.</p>
      @return
    @endif

    <table class="w-full border-collapse border border-gray-300 text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-3 py-2">Image</th>
          <th class="border px-3 py-2">Name &amp; Description</th>
          <th class="border px-3 py-2">Start</th>
          <th class="border px-3 py-2">User</th>
          <th class="border px-3 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pendingEvents as $event)
          <tr>
            <td class="border px-3 py-2 text-center">
              @if ($event->image_path)
                <img src="{{ asset('storage/'.$event->image_path) }}"
                     class="h-12 w-12 object-cover rounded" alt="Poster">
              @else
                —
              @endif
            </td>
            <td class="border px-3 py-2">
              <strong>{{ $event->name }}</strong><br>
              <span class="text-xs text-gray-600">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</span>
            </td>
            <td class="border px-3 py-2">{{ $event->start_datetime->format('d M Y, H:i') }}</td>
            <td class="border px-3 py-2">{{ $event->user->name }}</td>
            <td class="border px-3 py-2 space-y-4">
              {{-- Approve Form --}}
              <form method="POST" action="{{ route('admin.vetting.approve', $event) }}">
                @csrf
                <textarea 
                  name="vetting_comments" 
                  rows="2"
                  class="w-full border px-2 py-1 text-sm mb-1" 
                  placeholder="Optional note for approval">{{ old('vetting_comments') }}</textarea>
                <button 
                  type="submit" 
                  class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
                  Approve
                </button>
              </form>

              {{-- Reject Form --}}
              <form method="POST" action="{{ route('admin.vetting.reject', $event) }}">
                @csrf
                <textarea 
                  name="vetting_comments" 
                  rows="2"
                  class="w-full border px-2 py-1 text-sm mb-1" 
                  placeholder="Reason for rejection" 
                  required>{{ old('vetting_comments') }}</textarea>
                <button 
                  type="submit" 
                  class="inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
                  Reject
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-layouts.app>
