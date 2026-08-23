{{--
    <x-layout.topbar :user="auth()->user()" role="HR Manager" />
--}}
@props(['user' => null, 'role' => null])

<header class="flex items-center justify-between gap-4 px-6 py-4 bg-neutral-25 border-b border-neutral-300/40">
    <div class="flex items-center gap-3 flex-1">
        @if($role)
            <button type="button" class="flex items-center gap-2 px-3 py-2 rounded-input ring-1 ring-neutral-300 text-sm text-neutral-700 shrink-0">
                <span class="w-2 h-2 rounded-full bg-primary-600"></span>
                {{ $role }}
                <span class="text-neutral-400">▾</span>
            </button>
        @endif

        <div class="relative flex-1 max-w-md">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400 text-sm" aria-hidden="true">🔍</span>
            <input
                type="text"
                placeholder="Search SmartHR..."
                class="w-full pl-9 pr-3 py-2 rounded-input bg-neutral-100/60 text-sm placeholder:text-neutral-400 border-0 focus:ring-2 focus:ring-primary-500"
            >
        </div>
    </div>

    <div class="flex items-center gap-4 shrink-0">
        <button type="button" class="relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-neutral-100" aria-label="Notifications">
            🔔
            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-primary-600"></span>
        </button>
        @if($user)
            <x-avatar :name="$user->name" size="md" />
        @endif
    </div>
</header>
