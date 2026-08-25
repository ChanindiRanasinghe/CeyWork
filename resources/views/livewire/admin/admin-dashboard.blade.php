<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Settings & RBAC</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                Manage roles, permissions, departments, and system config
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#b91c1c]"></span>
                <span>System Administrator Only</span>
            </span>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="border-b border-slate-200/80 flex items-center gap-8 pt-2 text-sm font-bold">
        <button 
            type="button" 
            wire:click="setTab('roles')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'roles' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Roles & Permissions
        </button>
        <button 
            type="button" 
            wire:click="setTab('departments')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'departments' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Departments
        </button>
        <button 
            type="button" 
            wire:click="setTab('users')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'users' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Users
        </button>
    </div>

    <!-- Toast Alert Notification -->
    @if($toastMessage)
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between gap-3 text-xs font-extrabold text-emerald-900 shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ $toastMessage }}</span>
            </div>
            <button wire:click="$set('toastMessage', '')" class="text-emerald-500 hover:text-emerald-800 font-black text-sm">✕</button>
        </div>
    @endif

    <!-- TAB 1: Roles & Permissions Matrix -->
    @if($activeTab === 'roles')
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Permission Matrix</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Module-level access control per role</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3 w-56">MODULE</th>
                            @foreach($rolesList as $roleKey => $roleName)
                                <th class="pb-3 px-3 text-center uppercase">{{ $roleName }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($permissionMatrix as $index => $row)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-3 font-extrabold text-slate-900 text-sm">
                                    {{ $row['module'] }}
                                </td>
                                @foreach($rolesList as $roleKey => $roleName)
                                    <td class="py-4 px-3 text-center">
                                        <button 
                                            type="button" 
                                            wire:click="togglePermission({{ $index }}, '{{ $roleKey }}')"
                                            class="inline-flex items-center justify-center p-1 rounded-full hover:bg-slate-100 transition cursor-pointer"
                                            title="Toggle permission for {{ $roleName }}"
                                        >
                                            @if($row['permissions'][$roleKey])
                                                <!-- Green Circle Checkmark -->
                                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.5 12.5l2.5 2.5 4.5-4.5" />
                                                </svg>
                                            @else
                                                <!-- Light Grey Cross -->
                                                <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                        </button>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- TAB 2: Departments Management -->
    @if($activeTab === 'departments')
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Organizational Departments</h3>
                    <p class="text-xs text-slate-400 font-semibold mt-0.5">Manage company structure and department allocations</p>
                </div>
            </div>

            <!-- Create Department Form -->
            <form wire:submit.prevent="addDepartment" class="bg-slate-50 p-4 rounded-2xl border border-slate-200 flex flex-col sm:flex-row items-end gap-3 text-xs">
                <div class="flex-1 w-full">
                    <label class="block font-bold text-slate-700 mb-1">Department Name *</label>
                    <input 
                        type="text" 
                        wire:model="newDeptName" 
                        placeholder="e.g. Quality Assurance" 
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl font-medium text-slate-900 focus:border-[#b91c1c] focus:outline-none"
                    />
                    @error('newDeptName') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="w-full sm:w-40">
                    <label class="block font-bold text-slate-700 mb-1">Dept Code *</label>
                    <input 
                        type="text" 
                        wire:model="newDeptCode" 
                        placeholder="QA" 
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl font-medium text-slate-900 focus:border-[#b91c1c] focus:outline-none"
                    />
                    @error('newDeptCode') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>
                <button 
                    type="submit" 
                    class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white font-extrabold text-xs rounded-xl shadow-xs transition shrink-0"
                >
                    + Add Department
                </button>
            </form>

            <!-- Departments Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3">DEPARTMENT NAME</th>
                            <th class="pb-3 px-3">CODE</th>
                            <th class="pb-3 px-3">HEADCOUNT</th>
                            <th class="pb-3 px-3">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($departments as $dept)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-3 font-extrabold text-slate-900 text-sm">{{ $dept->name }}</td>
                                <td class="py-3.5 px-3 font-mono font-bold text-slate-500">{{ $dept->code }}</td>
                                <td class="py-3.5 px-3 font-bold text-slate-700">{{ $dept->employees_count }} staff</td>
                                <td class="py-3.5 px-3">
                                    <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold rounded-full">
                                        Active
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- TAB 3: User Accounts Management -->
    @if($activeTab === 'users')
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">User Accounts & Assigned Roles</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Manage user access and assigned RBAC security roles</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3">USER NAME</th>
                            <th class="pb-3 px-3">EMAIL</th>
                            <th class="pb-3 px-3">ASSIGNED ROLE</th>
                            <th class="pb-3 px-3">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($users as $usr)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-3 font-extrabold text-slate-900 text-sm">{{ $usr->name }}</td>
                                <td class="py-3.5 px-3 font-mono text-slate-500">{{ $usr->email }}</td>
                                <td class="py-3.5 px-3">
                                    <span class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-200 font-extrabold text-xs rounded-full">
                                        {{ $usr->roles->pluck('name')->first() ?? 'Standard Employee' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3">
                                    <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold rounded-full">
                                        Active
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
