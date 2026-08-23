{{--
    <x-empty-state
        icon="📭"
        title="No open positions"
        description="Once you post a role, it'll show up here."
    >
        <x-button>+ Post a Role</x-button>
    </x-empty-state>
--}}
@props(['icon' => '—', 'title', 'description' => null])

<div class="flex flex-col items-center justify-center text-center py-12 px-6">
    <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center text-xl mb-4">
        {{ $icon }}
    </div>
    <h4 class="text-sm font-semibold text-neutral-900">{{ $title }}</h4>
    @if($description)
        <p class="text-sm text-neutral-500 mt-1 max-w-xs">{{ $description }}</p>
    @endif
    @isset($slot)
        <div class="mt-4">{{ $slot }}</div>
    @endisset
</div>
