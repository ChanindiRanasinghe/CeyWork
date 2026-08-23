{{--
    <x-alert-banner dismissible>
        3 leave requests pending approval · Payroll run due Aug 25 · 2 KPIs at risk this quarter
    </x-alert-banner>
--}}
@props(['dismissible' => false, 'variant' => 'warning'])

@php
$variants = [
    'warning' => 'bg-warning-50 text-neutral-900',
    'info'    => 'bg-brand-teal/10 text-neutral-900',
][$variant] ?? 'bg-warning-50 text-neutral-900';
@endphp

<div
    x-data="{ open: true }"
    x-show="open"
    {{ $attributes->merge(['class' => "rounded-card px-4 py-3 flex items-center justify-between gap-4 $variants"]) }}
>
    <div class="flex items-center gap-2 text-sm">
        <span aria-hidden="true">⚠</span>
        <span>{{ $slot }}</span>
    </div>
    @if($dismissible)
        <button type="button" @click="open = false" class="text-xs font-medium text-warning-700 hover:underline shrink-0">
            Dismiss
        </button>
    @endif
</div>
