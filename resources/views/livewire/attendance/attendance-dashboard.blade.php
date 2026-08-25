<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Attendance & Leave</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                Sri Lanka Statutory Leave Entitlements & Employee Balances
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>Visible to All Employees</span>
            </span>
        </div>
    </div>

    <!-- Toast Notification Banner -->
    @if($toastMessage)
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl p-4 flex items-center justify-between text-xs sm:text-sm font-bold shadow-xs">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>{{ $toastMessage }}</span>
            </div>
            <button wire:click="$set('toastMessage', '')" class="text-emerald-700 hover:text-emerald-900 font-black">✕</button>
        </div>
    @endif

    <!-- Navigation Tabs -->
    <div class="border-b border-slate-200/80 flex items-center gap-8 text-sm font-bold">
        <button 
            type="button" 
            wire:click="setTab('balances')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'balances' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-400 hover:text-slate-700' }}"
        >
            Leave Balances
        </button>
        
        @if($isManager)
            <button 
                type="button" 
                wire:click="setTab('requests')"
                class="pb-3 border-b-2 transition {{ $activeTab === 'requests' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-400 hover:text-slate-700' }}"
            >
                Pending Requests ({{ $pendingCount }})
            </button>
            <button 
                type="button" 
                wire:click="setTab('attendance')"
                class="pb-3 border-b-2 transition {{ $activeTab === 'attendance' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-400 hover:text-slate-700' }}"
            >
                Daily Attendance Logs
            </button>
        @endif
    </div>

    <!-- TAB 1: LEAVE BALANCES (VISIBLE TO EVERYONE) -->
    @if($activeTab === 'balances')
        <!-- Statutory Quota Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-5 bg-white rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700 shrink-0 font-black text-base">
                    14d
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">ANNUAL LEAVE</p>
                    <p class="text-lg font-black text-slate-900 tracking-tight mt-0.5">14 Days / Year</p>
                    <p class="text-[11px] font-semibold text-slate-400">Full annual entitlement</p>
                </div>
            </div>

            <div class="p-5 bg-white rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-700 shrink-0 font-black text-base">
                    7d
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">CASUAL LEAVE</p>
                    <p class="text-lg font-black text-slate-900 tracking-tight mt-0.5">7 Days / Year</p>
                    <p class="text-[11px] font-semibold text-slate-400">Granted per calendar year</p>
                </div>
            </div>

            <div class="p-5 bg-white rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-[#b91c1c] shrink-0 font-black text-base">
                    14d
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">SICK LEAVE</p>
                    <p class="text-lg font-black text-slate-900 tracking-tight mt-0.5">14 Days / Year</p>
                    <p class="text-[11px] font-semibold text-slate-400">Medical entitlement</p>
                </div>
            </div>
        </div>

        <!-- Main Balances Table Container -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <!-- Search & Subheader -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Remaining Employee Balances</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Track remaining days available per leave category</p>
                </div>
                <div class="w-full sm:w-72">
                    <input 
                        type="text" 
                        wire:model.live="searchQuery"
                        placeholder="Search employee or department..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#00b4a2]"
                    />
                </div>
            </div>

            <!-- Balances Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3">EMPLOYEE</th>
                            <th class="pb-3 px-3">DEPARTMENT</th>
                            <th class="pb-3 px-3">ANNUAL (14d)</th>
                            <th class="pb-3 px-3">CASUAL (7d)</th>
                            <th class="pb-3 px-3">SICK (14d)</th>
                            <th class="pb-3 px-3 text-right">TOTAL REMAINING</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($balancesList as $emp)
                            @php
                                $totalRemaining = $emp['annualRemaining'] + $emp['casualRemaining'] + $emp['sickRemaining'];
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition">
                                <!-- Employee Name & Initials -->
                                <td class="py-4 px-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-700 text-white font-black text-xs flex items-center justify-center shadow-xs shrink-0">
                                            {{ $emp['initials'] }}
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-slate-900 text-sm leading-tight">{{ $emp['name'] }}</p>
                                            <p class="text-[11px] text-slate-400 font-medium leading-tight mt-0.5">{{ $emp['designation'] }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Department -->
                                <td class="py-4 px-3 font-bold text-slate-600">
                                    {{ $emp['department'] }}
                                </td>

                                <!-- Annual Leave Remaining -->
                                <td class="py-4 px-3">
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-[11px] font-extrabold">
                                            <span class="text-slate-900">{{ $emp['annualRemaining'] }} left</span>
                                            <span class="text-slate-400 font-semibold">{{ $emp['annualTaken'] }} taken</span>
                                        </div>
                                        <div class="w-32 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-amber-500 rounded-full" style="width: {{ min(100, ($emp['annualRemaining'] / 14) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Casual Leave Remaining -->
                                <td class="py-4 px-3">
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-[11px] font-extrabold">
                                            <span class="text-slate-900">{{ $emp['casualRemaining'] }} left</span>
                                            <span class="text-slate-400 font-semibold">{{ $emp['casualTaken'] }} taken</span>
                                        </div>
                                        <div class="w-28 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min(100, ($emp['casualRemaining'] / 7) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Sick Leave Remaining -->
                                <td class="py-4 px-3">
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-[11px] font-extrabold">
                                            <span class="text-slate-900">{{ $emp['sickRemaining'] }} left</span>
                                            <span class="text-slate-400 font-semibold">{{ $emp['sickTaken'] }} taken</span>
                                        </div>
                                        <div class="w-32 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-rose-500 rounded-full" style="width: {{ min(100, ($emp['sickRemaining'] / 14) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Total Remaining Badge & Admin Action -->
                                <td class="py-4 px-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($isManager)
                                            <button 
                                                type="button" 
                                                wire:click="openEditBalanceModal({{ $emp['id'] }})"
                                                class="px-2.5 py-1 text-xs font-bold rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 transition"
                                                title="Admin Edit Leave Balance"
                                            >
                                                ✏️ Edit
                                            </button>
                                        @endif
                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 font-black text-xs rounded-xl inline-block shadow-2xs">
                                            {{ $totalRemaining }} Days
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- TAB 2: PENDING REQUESTS (MANAGEMENT ONLY) -->
    @if($activeTab === 'requests' && $isManager)
        <!-- Main Data Table Container -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs overflow-hidden space-y-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <h3 class="text-base font-extrabold text-slate-900">Leave Requests Approval</h3>
                    <span class="px-2.5 py-0.5 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">
                        {{ count($requestsList) }} total
                    </span>
                </div>
                <div class="flex items-center gap-1.5 text-xs font-bold bg-slate-100 p-1 rounded-xl">
                    <button type="button" wire:click="setStatusFilter('all')" class="px-3 py-1.5 rounded-lg transition {{ $statusFilter === 'all' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-500' }}">All</button>
                    <button type="button" wire:click="setStatusFilter('pending')" class="px-3 py-1.5 rounded-lg transition {{ $statusFilter === 'pending' ? 'bg-white text-purple-700 shadow-xs' : 'text-slate-500' }}">Pending</button>
                    <button type="button" wire:click="setStatusFilter('approved')" class="px-3 py-1.5 rounded-lg transition {{ $statusFilter === 'approved' ? 'bg-white text-emerald-700 shadow-xs' : 'text-slate-500' }}">Approved</button>
                    <button type="button" wire:click="setStatusFilter('rejected')" class="px-3 py-1.5 rounded-lg transition {{ $statusFilter === 'rejected' ? 'bg-white text-rose-700 shadow-xs' : 'text-slate-500' }}">Rejected</button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3">EMPLOYEE</th>
                            <th class="pb-3 px-3">TYPE</th>
                            <th class="pb-3 px-3">PERIOD</th>
                            <th class="pb-3 px-3">DAYS</th>
                            <th class="pb-3 px-3">STATUS</th>
                            <th class="pb-3 px-3 text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($requestsList as $req)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-[#b91c1c] text-white font-black text-xs flex items-center justify-center shadow-xs shrink-0">
                                            {{ $req['initials'] }}
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-slate-900 text-sm leading-tight">{{ $req['name'] }}</p>
                                            <p class="text-[11px] text-slate-400 font-medium leading-tight mt-0.5">{{ $req['department'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-3 font-bold text-slate-800">{{ $req['type'] }}</td>
                                <td class="py-4 px-3 text-slate-500 font-medium">{{ $req['period'] }}</td>
                                <td class="py-4 px-3 font-extrabold text-slate-900">{{ $req['days'] }}</td>
                                <td class="py-4 px-3">
                                    @if($req['status'] === 'pending')
                                        <span class="px-3 py-1 bg-purple-100/90 text-purple-700 font-bold text-xs rounded-full inline-block">Pending</span>
                                    @elseif($req['status'] === 'approved')
                                        <span class="px-3 py-1 bg-emerald-100/90 text-emerald-800 font-bold text-xs rounded-full inline-block">Approved</span>
                                    @else
                                        <span class="px-3 py-1 bg-rose-100/90 text-rose-800 font-bold text-xs rounded-full inline-block">Rejected</span>
                                    @endif
                                </td>
                                <td class="py-4 px-3 text-right">
                                    @if($req['status'] === 'pending')
                                        <div class="flex items-center justify-end gap-2">
                                            <button type="button" wire:click="approveRequest({{ $req['id'] }})" class="px-3.5 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-extrabold text-xs rounded-xl border border-emerald-200">✓ Approve</button>
                                            <button type="button" wire:click="rejectRequest({{ $req['id'] }})" class="px-3.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-extrabold text-xs rounded-xl border border-rose-200">✕ Reject</button>
                                        </div>
                                    @else
                                        <span class="text-slate-300 font-bold text-sm">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- TAB 3: DAILY ATTENDANCE LOGS (MANAGEMENT ONLY) -->
    @if($activeTab === 'attendance' && $isManager)
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900">Daily Attendance Log</h3>
                <p class="text-xs text-slate-500 font-medium">Real-time check-in and check-out logs for Friday, 22 August 2026</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3">EMPLOYEE</th>
                            <th class="pb-3 px-3">DEPARTMENT</th>
                            <th class="pb-3 px-3">CHECK IN</th>
                            <th class="pb-3 px-3">CHECK OUT</th>
                            <th class="pb-3 px-3">WORK MODE</th>
                            <th class="pb-3 px-3">PUNCTUALITY</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($dailyAttendance as $log)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-3 font-extrabold text-slate-900">{{ $log['name'] }}</td>
                                <td class="py-3 px-3 text-slate-500">{{ $log['dept'] }}</td>
                                <td class="py-3 px-3 font-mono font-bold text-emerald-700">{{ $log['checkIn'] }}</td>
                                <td class="py-3 px-3 font-mono font-bold text-slate-700">{{ $log['checkOut'] }}</td>
                                <td class="py-3 px-3 font-semibold text-slate-600">{{ $log['workMode'] }}</td>
                                <td class="py-3 px-3">
                                    <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full {{ str_contains($log['status'], 'On Time') ? 'bg-emerald-100 text-emerald-800' : (str_contains($log['status'], 'Late') ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600') }}">
                                        {{ $log['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- ADMIN EDIT LEAVE BALANCES MODAL -->
    @if($showEditBalanceModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full border border-slate-200 shadow-2xl space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Edit Leave Balances (Admin)</h3>
                        <p class="text-xs text-slate-500 font-medium">Adjust remaining days for <strong>{{ $editingEmployeeName }}</strong></p>
                    </div>
                    <button wire:click="closeEditBalanceModal" class="text-slate-400 hover:text-slate-600 font-bold text-lg">✕</button>
                </div>

                <form wire:submit.prevent="updateLeaveBalance" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Annual Leave Remaining (Out of 14d) *</label>
                        <input 
                            type="number" 
                            wire:model="editAnnualRemaining" 
                            min="0" 
                            max="14" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                        />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Casual Leave Remaining (Out of 7d) *</label>
                        <input 
                            type="number" 
                            wire:model="editCasualRemaining" 
                            min="0" 
                            max="7" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                        />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Sick Leave Remaining (Out of 14d) *</label>
                        <input 
                            type="number" 
                            wire:model="editSickRemaining" 
                            min="0" 
                            max="14" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                        />
                    </div>

                    <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button 
                            type="button" 
                            wire:click="closeEditBalanceModal" 
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2 bg-[#b91c1c] hover:bg-[#a11818] text-white font-black text-xs rounded-xl shadow-xs transition"
                        >
                            Save Balances
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
