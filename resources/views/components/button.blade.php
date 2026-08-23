{{--
    <x-button>Sign In</x-button>
    <x-button variant="success">Activate Account</x-button>
    <x-button variant="ghost">Dismiss</x-button>
    <x-button as="a" href="/employees" variant="secondary">View all</x-button>
--}}
@props(['variant' => 'primary', 'as' => 'button'])

@php
$variants = [
    'primary'   => 'bg-primary-600 hover:bg-primary-700 text-white shadow-card',
    'success'   => 'bg-success-500 hover:bg-success-600 text-white shadow-card',
    'secondary' => 'bg-neutral-25 hover:bg-neutral-100 text-neutral-900 ring-1 ring-neutral-300',
    'ghost'     => 'bg-transparent hover:bg-neutral-100 text-neutral-700',
][$variant] ?? 'bg-primary-600 text-white';

$tag = $as === 'a' ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-2 rounded-input px-4 py-2.5 text-sm font-semibold transition-colors $variants"]) }}>
    {{ $slot }}
</{{ $tag }}>
