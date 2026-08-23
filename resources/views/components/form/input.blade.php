{{--
    <x-form.input label="Email Address" type="email" name="email" placeholder="you@acme.com" icon="✉" />
    <x-form.input label="Password" type="password" name="password" icon="🔒" toggle />
--}}
@props(['label' => null, 'icon' => null, 'toggle' => false, 'error' => null])

<div>
    @if($label)
        <label class="block text-xs font-semibold tracking-wide text-neutral-500 uppercase mb-1.5">
            {{ $label }}
        </label>
    @endif
    <div class="relative">
        @if($icon)
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400" aria-hidden="true">{{ $icon }}</span>
        @endif
        <input
            {{ $attributes->merge([
                'class' => 'w-full rounded-input bg-neutral-100/50 border border-neutral-300/60 py-2.5 text-sm text-neutral-900 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent '
                    . ($icon ? 'pl-9 pr-3' : 'px-3')
                    . ($error ? ' ring-1 ring-primary-500' : '')
            ]) }}
        >
        @if($toggle)
            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-400" aria-label="Show password">
                👁
            </button>
        @endif
    </div>
    @if($error)
        <p class="text-xs text-primary-600 mt-1">{{ $error }}</p>
    @endif
</div>
