<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Twedl – Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">
    <x-nav />
    <div class="min-h-screen flex items-center justify-center flex-col px-4">
        {{ $slot }}
    </div>
</body>
</html>
