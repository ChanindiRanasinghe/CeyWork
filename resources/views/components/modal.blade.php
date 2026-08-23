{{--
    <x-modal name="add-employee" title="Add Employee">
        form fields...
        <x-slot:footer>
            <x-button variant="secondary" @click="$dispatch('close-modal', 'add-employee')">Cancel</x-button>
            <x-button>Save</x-button>
        </x-slot:footer>
    </x-modal>
--}}
@props(['name', 'title' => null])

<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') open = true"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center px-4"
>
    <div class="absolute inset-0 bg-neutral-900/40" @click="open = false"></div>

    <div
        x-show="open"
        x-transition
        class="relative bg-neutral-25 rounded-card shadow-modal w-full max-w-lg p-6"
    >
        <div class="flex items-start justify-between mb-4">
            @if($title)
                <h3 class="text-lg font-semibold text-neutral-900">{{ $title }}</h3>
            @endif
            <button @click="open = false" class="text-neutral-400 hover:text-neutral-700" aria-label="Close">✕</button>
        </div>

        <div>{{ $slot }}</div>

        @isset($footer)
            <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-neutral-300/50">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
