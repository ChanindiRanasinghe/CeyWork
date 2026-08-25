<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Asset Management</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                {{ count($assetsList) }} assets registered · {{ $inRepairCount }} in repair
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button 
                type="button" 
                wire:click="openCreateModal"
                class="px-4 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white text-xs font-black rounded-2xl shadow-sm hover:shadow transition flex items-center gap-2 cursor-pointer"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                <span>+ Register Asset</span>
            </button>

            <span class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#b91c1c]"></span>
                <span>Admin Restricted Access</span>
            </span>
        </div>
    </div>

    <!-- Success Notification Banner -->
    @if($successMessage)
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between gap-3 text-xs font-extrabold text-emerald-900 shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ $successMessage }}</span>
            </div>
            <button wire:click="dismissSuccessMessage" class="text-emerald-500 hover:text-emerald-800 font-black text-sm">✕</button>
        </div>
    @endif

    <!-- Assets Table Container -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                        <th class="pb-3 px-3">ASSET</th>
                        <th class="pb-3 px-3">CATEGORY</th>
                        <th class="pb-3 px-3">SERIAL NO.</th>
                        <th class="pb-3 px-3">ASSIGNED TO</th>
                        <th class="pb-3 px-3">CONDITION</th>
                        <th class="pb-3 px-3">DATE ASSIGNED</th>
                        <th class="pb-3 px-3 text-right">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                    @foreach($assetsList as $asset)
                        <tr class="hover:bg-slate-50/80 transition">
                            <!-- ASSET Name & Icon -->
                            <td class="py-4 px-3">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-10 h-10 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500 shrink-0">
                                        @if($asset['icon'] === 'monitor')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        @elseif($asset['icon'] === 'phone')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        @elseif($asset['icon'] === 'keyboard')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-extrabold text-slate-900 text-sm leading-tight">{{ $asset['name'] }}</p>
                                        <p class="text-[11px] text-slate-400 font-semibold leading-tight mt-0.5">{{ $asset['code'] }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- CATEGORY -->
                            <td class="py-4 px-3 font-semibold text-slate-600">
                                {{ $asset['category'] }}
                            </td>

                            <!-- SERIAL NO. -->
                            <td class="py-4 px-3 font-mono font-semibold text-slate-500">
                                {{ $asset['serial_no'] }}
                            </td>

                            <!-- ASSIGNED TO -->
                            <td class="py-4 px-3 font-extrabold text-slate-900">
                                {{ $asset['assigned_to'] }}
                            </td>

                            <!-- CONDITION -->
                            <td class="py-4 px-3">
                                <span class="px-3 py-1 font-bold text-[11px] rounded-full border {{ $asset['conditionClass'] }}">
                                    {{ $asset['condition'] }}
                                </span>
                            </td>

                            <!-- DATE ASSIGNED -->
                            <td class="py-4 px-3 font-semibold text-slate-500">
                                {{ $asset['date_assigned'] }}
                            </td>

                            <!-- ACTIONS -->
                            <td class="py-4 px-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button 
                                        type="button" 
                                        wire:click="openEditModal({{ $asset['id'] }})"
                                        class="px-2.5 py-1 text-xs font-bold rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 transition"
                                        title="Admin Edit Asset"
                                    >
                                        ✏️ Edit
                                    </button>
                                    <button 
                                        type="button" 
                                        wire:click="deleteAsset({{ $asset['id'] }})"
                                        class="px-2.5 py-1 text-xs font-bold rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition"
                                        title="Admin Delete Asset"
                                    >
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- CREATE / EDIT ASSET MODAL (Admin Only) -->
    @if($showCreateModal || $showEditModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full border border-slate-200 shadow-2xl space-y-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">
                            {{ $showEditModal ? 'Edit Asset Details (Admin)' : 'Register New Asset' }}
                        </h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            {{ $showEditModal ? 'Update hardware assignments and condition status' : 'Register company hardware and assign to staff' }}
                        </p>
                    </div>
                    <button wire:click="closeCreateModal" class="text-slate-400 hover:text-slate-600 font-bold text-lg">✕</button>
                </div>

                <!-- Form Fields -->
                <form wire:submit.prevent="{{ $showEditModal ? 'updateAsset' : 'createAsset' }}" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Asset Name / Model *</label>
                        <input 
                            type="text" 
                            wire:model="name" 
                            placeholder="e.g. MacBook Pro 16&quot;" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                        />
                        @error('name') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Asset Code *</label>
                            <input 
                                type="text" 
                                wire:model="code" 
                                placeholder="AST-007" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Category *</label>
                            <select 
                                wire:model="category" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            >
                                <option value="Laptop">Laptop</option>
                                <option value="Monitor">Monitor</option>
                                <option value="Phone">Phone</option>
                                <option value="Keyboard">Keyboard</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Accessories">Accessories</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Serial Number *</label>
                            <input 
                                type="text" 
                                wire:model="serial_no" 
                                placeholder="C02XJ1GYJGH7" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-mono text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Assigned To Employee</label>
                            <input 
                                type="text" 
                                wire:model="assigned_to" 
                                placeholder="Amara Osei or Unassigned" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Condition Status *</label>
                            <select 
                                wire:model="condition" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            >
                                <option value="Good">Good</option>
                                <option value="In Repair">In Repair</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Decommissioned">Decommissioned</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Date Assigned</label>
                            <input 
                                type="text" 
                                wire:model="date_assigned" 
                                placeholder="Feb 2021" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button 
                            type="button" 
                            wire:click="closeCreateModal" 
                            class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white font-extrabold text-xs rounded-xl shadow-xs transition"
                        >
                            {{ $showEditModal ? 'Update Asset Details' : 'Save Asset Record' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
