{{--
    <x-layout.sidebar-nav-item href="/dashboard" icon="grid" :active="true">
        Dashboard
    </x-layout.sidebar-nav-item>
--}}
@props(['href' => '#', 'active' => false, 'icon' => null])


    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'flex items-center gap-3 px-3 py-2 rounded-input text-sm font-medium transition-colors '
            . ($active
                ? 'bg-primary-600 text-white'
                : 'text-white/80 hover:bg-white/10 hover:text-white')
    ]) }}
>
    @if($icon)
        <span class="w-4 h-4 shrink-0" aria-hidden="true">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</a>
