@props(['title' => 'CEYWork HR System', 'user' => null])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex">

    <!-- Sidebar -->
    <x-layout.sidebar :user="$user ?? auth()->user()" />

    <!-- Main Section -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">
        <x-layout.topbar :user="$user ?? auth()->user()" />

        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
