<div class="bg-neutral-25 rounded-card shadow-card overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-neutral-300/50">
                @foreach($columns as $column)
                    <th class="text-left px-5 py-3 text-xs font-semibold tracking-wide text-neutral-400 uppercase">
                        @if($column['sortable'] ?? false)
                            <button
                                wire:click="sortBy('{{ $column['key'] }}')"
                                class="flex items-center gap-1 hover:text-neutral-700"
                            >
                                {{ $column['label'] }}
                                @if($sortField === $column['key'])
                                    <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        @else
                            {{ $column['label'] }}
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody wire:loading.class="opacity-50" class="divide-y divide-neutral-300/30">
            @forelse($rows as $row)
                @if($rowView)
                    @include($rowView, ['row' => $row])
                @else
                    <tr class="hover:bg-neutral-100/40">
                        @foreach($columns as $column)
                            <td class="px-5 py-3.5 text-neutral-700">
                                @if(($column['type'] ?? null) === 'badge')
                                    <x-badge :status="strtolower($row->{$column['key']})">
                                        {{ $row->{$column['key']} }}
                                    </x-badge>
                                @else
                                    {{ $row->{$column['key']} }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}">
                        <x-empty-state
                            icon="📭"
                            title="Nothing here yet"
                            description="Once records are added, they'll show up in this table."
                        />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($rows->hasPages())
        <div class="px-5 py-3 border-t border-neutral-300/50">
            {{ $rows->links() }}
        </div>
    @endif

    <div wire:loading class="px-5 py-3">
        <x-loading-state rows="3" />
    </div>
</div>
