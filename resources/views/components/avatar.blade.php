{{--
    <x-avatar name="Amara Osei" />
    <x-avatar name="Sarah Reynolds" size="lg" />
--}}
@props(['name', 'size' => 'md'])

@php
$initials = collect(explode(' ', trim($name)))
    ->map(fn($p) => mb_substr($p, 0, 1))
    ->take(2)
    ->implode('');

$sizes = [
    'sm' => 'w-7 h-7 text-xs',
    'md' => 'w-9 h-9 text-sm',
    'lg' => 'w-11 h-11 text-base',
][$size] ?? 'w-9 h-9 text-sm';

$shades = ['#b10a0a', '#dc201f', '#e34f4c', '#c8302d'];
$shade = $shades[crc32($name) % count($shades)];
@endphp

<div
    {{ $attributes->merge(['class' => "$sizes rounded-full flex items-center justify-center font-semibold text-white shrink-0"]) }}
    style="background-color: {{ $shade }}"
>
    {{ strtoupper($initials) }}
</div>
