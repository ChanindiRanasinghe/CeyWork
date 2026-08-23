{{--
    <x-card title="Headcount Trend" action="...">
        content
    </x-card>
--}}
@props(['title' => null, 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'bg-neutral-25 rounded-card shadow-card p-6']) }}>
    @if($title || isset($action))
        <div class="flex items-start justify-between mb-4">
            <div>
                @if($title)
                    <h3 class="text-lg font-semibold text-neutral-900">{{ $title }}</h3>
                @endif
                @if($subtitle)
                    <p class="text-xs text-neutral-400 mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @isset($action)
                <div>{{ $action }}</div>
            @endisset
        </div>
    @endif

    {{ $slot }}
</div>
