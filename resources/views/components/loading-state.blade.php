{{--
    <x-loading-state rows="4" />
    <x-loading-state variant="card" />
--}}
@props(['variant' => 'rows', 'rows' => 3])

@if($variant === 'card')
    <div class="bg-neutral-25 rounded-card shadow-card p-5 animate-pulse">
        <div class="w-10 h-10 rounded-chip bg-neutral-100 mb-4"></div>
        <div class="h-3 w-24 bg-neutral-100 rounded mb-2"></div>
        <div class="h-6 w-16 bg-neutral-100 rounded"></div>
    </div>
@else
    <div class="space-y-3 animate-pulse">
        @for ($i = 0; $i < $rows; $i++)
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-neutral-100 shrink-0"></div>
                <div class="flex-1 space-y-2">
                    <div class="h-3 w-1/3 bg-neutral-100 rounded"></div>
                    <div class="h-2.5 w-1/2 bg-neutral-100 rounded"></div>
                </div>
            </div>
        @endfor
    </div>
@endif
