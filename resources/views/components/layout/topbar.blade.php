@props(['user' => null])

@php
$user = $user ?? auth()->user();
$roleName = $user?->roles->first()?->name ?? ($user?->isAdmin() ? 'System Administrator' : 'HR Manager');
$userName = $user?->name ?? 'Sarah Reynolds';
$userInitials = collect(explode(' ', $userName))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join('');
if (empty($userInitials)) { $userInitials = 'SR'; }
@endphp

<header class="flex items-center justify-between gap-4 px-8 py-4 bg-[#fdfbf4] border-b border-amber-100/60 shrink-0">
    <div class="flex items-center gap-3 flex-1">
        <!-- Role Selector Pill -->
        <div class="relative inline-block">
            <button type="button" class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm text-xs font-bold text-slate-800 hover:bg-slate-50 transition">
                <span class="w-2.5 h-2.5 rounded-full bg-[#b91c1c]"></span>
                <span>{{ $roleName }}</span>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                type="text" 
                placeholder="Search SmartHR..." 
                class="w-full bg-[#f4f6f9] border border-slate-200/80 text-slate-900 text-xs rounded-xl pl-10 pr-4 py-2 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition placeholder:text-slate-400"
            />
        </div>
    </div>

    <!-- Right Controls -->
    <div class="flex items-center gap-3">
        <!-- Bell Notification Button -->
        <button 
            type="button" 
            wire:click="$dispatch('toggleNotificationsDrawer')" 
            class="relative w-9 h-9 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 shadow-sm transition group"
            title="Notifications"
        >
            <svg class="w-4 h-4 text-slate-600 group-hover:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-[#b91c1c] text-white text-[9px] font-black rounded-full flex items-center justify-center border border-white">
                9
            </span>
        </button>

        <!-- User Avatar Circle -->
        <div class="w-8 h-8 rounded-full bg-[#b91c1c] text-white font-bold text-xs flex items-center justify-center shadow-sm">
            {{ $userInitials }}
        </div>
    </div>
</header>
