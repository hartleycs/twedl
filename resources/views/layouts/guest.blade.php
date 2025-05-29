{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.head')   {{-- your existing Meta/Title/etc --}}
  @stack('styles')            {{-- <<— this renders the Leaflet & Geocoder CSS pushed above --}}
</head>
<body>
  <x-nav />  {{-- your nav that handles both @auth and @guest links --}}
  <main class="min-h-screen">
    {{ $slot }}
  </main>
  @stack('scripts')           {{-- <<— renders the Leaflet/Geocoder JS and postcode lookup code --}}
</body>
</html>
