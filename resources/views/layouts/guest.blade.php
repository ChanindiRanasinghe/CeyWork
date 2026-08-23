<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CEYWork HR System' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen">
    {{ $slot }}
    @livewireScripts
</body>
</html>
