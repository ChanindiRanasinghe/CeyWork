{{--
    <x-badge status="active">Active</x-badge>
    <x-badge status="on-leave">On Leave</x-badge>
    <x-badge status="new">New</x-badge>
    <x-badge status="shortlisted">Shortlisted</x-badge>
    <x-badge status="rejected">Rejected</x-badge>
--}}
@props(['status' => 'default'])

@php
$styles = [
    'active'      => 'bg-neutral-25 text-success-700 ring-success-700/25',
    'on-leave'    => 'bg-warning-50 text-warning-700 ring-warning-500/30',
    'new'         => 'bg-primary-50 text-primary-600 ring-primary-600/20',
    'shortlisted' => 'bg-warning-50 text-warning-700 ring-warning-500/30',
    'interview'   => 'bg-brand-teal/10 text-brand-teal ring-brand-teal/30',
    'offered'     => 'bg-success-50 text-success-700 ring-success-700/25',
    'hired'       => 'bg-success-50 text-success-700 ring-success-700/25',
    'rejected'    => 'bg-primary-50 text-primary-600 ring-primary-600/25',
    'default'     => 'bg-neutral-100 text-neutral-700 ring-neutral-300',
][$status] ?? 'bg-neutral-100 text-neutral-700 ring-neutral-300';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1 rounded-badge px-2.5 py-1 text-xs font-medium ring-1 ring-inset $styles"]) }}>
    {{ $slot }}
</span>
