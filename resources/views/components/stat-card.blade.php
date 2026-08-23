{{--
    <x-stat-card
        label="Total Employees"
        value="284"
        delta="+3 vs last month"
        trend="up"
        icon="users"
    />
--}}
@props([
    'label',
    'value',
    'delta' => null,
    'trend' => 'up',
    'icon' => null,
])

@php
$trendColor = match($trend) {
    'up' => 'text-success-700',
    'down' => 'text-primary-600',
    default => 'text-neutral-400',
};
$trendArrow = match($trend) {
    'up' => '↗',
    'down' => '↘',
    default => '→',
};
@endphp

<div {{ $attributes->merge(['class' => 'bg-neutral-25 rounded-card shadow-card p-5 flex items-start gap-4']) }}>
    <div class="w-10 h-10 rounded-chip bg-chip-rose flex items-center justify-center shrink-0 text-primary-500">
        <span class="text-lg">{{ $icon }}</span>
    </div>
    <div class="min-w-0">
        <p class="text-xs font-medium tracking-wide text-neutral-400 uppercase">{{ $label }}</p>
        <p class="text-3xl font-semibold text-neutral-900 mt-1">{{ $value }}</p>
        @if($delta)
            <p class="text-xs {{ $trendColor }} mt-1 flex items-center gap-1">
                <span>{{ $trendArrow }}</span> {{ $delta }}
            </p>
        @endif
    </div>
</div>
