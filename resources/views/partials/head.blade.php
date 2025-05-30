{{-- resources/views/partials/head.blade.php --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net" />
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'] )

@fluxAppearance

{{-- Enhanced UI Styles and Scripts --}}
<link rel="stylesheet" href="{{ asset('css/enhanced-styles.css') }}">
<script src="{{ asset('js/animations.js') }}" defer></script>

{{-- Leaflet + Geocoder CSS (no integrity/crossorigin to avoid browser blocking) --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

@stack('head' )
