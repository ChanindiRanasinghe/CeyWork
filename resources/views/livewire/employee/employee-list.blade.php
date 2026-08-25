<div class="space-y-6">
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Employee Directory</h1>
            <p class="text-slate-500 text-sm">Manage complete employee files, Sri Lankan statutory records (EPF/ETF/B-Card), and department info.</p>
        </div>
        <button wire:click="$set('showCreateModal', true)" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow-sm transition">
            <span>+ Add New Employee</span>
        </button>
    </div>

    @if (session()->has('message'))
        <x-alert-banner dismissible>
            {{ session('message') }}
        </x-alert-banner>
    @endif

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Search by name, EMP code, NIC/Passport, or designation..." 
                class="w-full text-sm border border-slate-300 rounded-lg px-3.5 py-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none"
            />
        </div>
        <div class="w-full md:w-48">
            <select wire:model.live="departmentFilter" class="w-full text-sm border border-slate-300 rounded-lg px-3.5 py-2.5 focus:ring-2 focus:ring-teal-500">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-40">
            <select wire:model.live="statusFilter" class="w-full text-sm border border-slate-300 rounded-lg px-3.5 py-2.5 focus:ring-2 focus:ring-teal-500">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="on-leave">On Leave</option>
                <option value="suspended">Suspended</option>
                <option value="terminated">Terminated</option>
            </select>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-700 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3.5">Employee</th>
                    <th class="px-6 py-3.5">Department & Position</th>
                    <th class="px-6 py-3.5">Sri Lanka Statutory Info</th>
                    <th class="px-6 py-3.5">Basic Salary</th>
                    <th class="px-6 py-3.5">Status</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($employees as $emp)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <x-avatar :name="$emp->full_name" size="md" />
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $emp->full_name }}</p>
                                    <p class="text-xs text-slate-500 font-mono">{{ $emp->employee_code }} · {{ $emp->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-800">{{ $emp->designation }}</p>
                            <p class="text-xs text-slate-500">{{ $emp->department?->name ?? 'Unassigned' }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs font-mono">
                            <p><span class="text-slate-400">NIC:</span> {{ $emp->nic_passport ?? 'N/A' }}</p>
                            <p><span class="text-slate-400">EPF/ETF:</span> {{ $emp->epf_number ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-900 font-mono">
                            Rs. {{ number_format($emp->basic_salary, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <x-badge :status="$emp->status">{{ ucfirst($emp->status) }}</x-badge>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button 
                                    type="button" 
                                    wire:click="openEditModal({{ $emp->id }})" 
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 transition"
                                    title="Admin Edit Employee"
                                >
                                    ✏️ Edit
                                </button>
                                <button 
                                    type="button" 
                                    wire:click="deleteEmployee({{ $emp->id }})" 
                                    onclick="return confirm('Are you sure you want to delete this employee record?')"
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition"
                                    title="Admin Delete Employee"
                                >
                                    🗑️
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            No employees found matching criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-slate-200">
            {{ $employees->links() }}
        </div>
    </div>

    <!-- Create Employee Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-2xl w-full p-6 space-y-6 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900">Add New Employee Record</h2>
                    <button wire:click="$set('showCreateModal', false)" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>

                <form wire:submit.prevent="createEmployee" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">First Name *</label>
                            <input type="text" wire:model="first_name" class="w-full text-sm border rounded-lg p-2.5">
                            @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Last Name *</label>
                            <input type="text" wire:model="last_name" class="w-full text-sm border rounded-lg p-2.5">
                            @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Employee Code *</label>
                            <input type="text" wire:model="employee_code" placeholder="EMP-0003" class="w-full text-sm border rounded-lg p-2.5">
                            @error('employee_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Email *</label>
                            <input type="email" wire:model="email" class="w-full text-sm border rounded-lg p-2.5">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Department *</label>
                            <select wire:model="department_id" class="w-full text-sm border rounded-lg p-2.5">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Designation *</label>
                            <input type="text" wire:model="designation" placeholder="e.g. Software Engineer" class="w-full text-sm border rounded-lg p-2.5">
                            @error('designation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">NIC / Passport</label>
                            <input type="text" wire:model="nic_passport" placeholder="199012345678" class="w-full text-sm border rounded-lg p-2.5">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Basic Salary (LKR) *</label>
                            <input type="number" step="0.01" wire:model="basic_salary" placeholder="150000" class="w-full text-sm border rounded-lg p-2.5">
                            @error('basic_salary') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 bg-slate-50 p-3 rounded-lg border border-slate-200">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">EPF No.</label>
                            <input type="text" wire:model="epf_number" class="w-full text-xs border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">ETF No.</label>
                            <input type="text" wire:model="etf_number" class="w-full text-xs border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">B Card No.</label>
                            <input type="text" wire:model="b_card_no" class="w-full text-xs border rounded p-2">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <button type="button" wire:click="$set('showCreateModal', false)" class="px-4 py-2 text-sm text-slate-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 text-sm bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-semibold">Save Employee</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Edit Employee Modal (Admin) -->
    @if($showEditModal)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-2xl w-full p-6 space-y-6 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900">Edit Employee Record (Admin Controls)</h2>
                    <button wire:click="$set('showEditModal', false)" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
                </div>

                <form wire:submit.prevent="updateEmployee" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">First Name *</label>
                            <input type="text" wire:model="first_name" class="w-full text-sm border rounded-lg p-2.5">
                            @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Last Name *</label>
                            <input type="text" wire:model="last_name" class="w-full text-sm border rounded-lg p-2.5">
                            @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Employee Code *</label>
                            <input type="text" wire:model="employee_code" class="w-full text-sm border rounded-lg p-2.5">
                            @error('employee_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Email *</label>
                            <input type="email" wire:model="email" class="w-full text-sm border rounded-lg p-2.5">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Status *</label>
                            <select wire:model="status" class="w-full text-sm border rounded-lg p-2.5 font-bold">
                                <option value="active">Active</option>
                                <option value="on-leave">On Leave</option>
                                <option value="suspended">Suspended</option>
                                <option value="terminated">Terminated</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Department *</label>
                            <select wire:model="department_id" class="w-full text-sm border rounded-lg p-2.5">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Designation *</label>
                            <input type="text" wire:model="designation" class="w-full text-sm border rounded-lg p-2.5">
                            @error('designation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">NIC / Passport</label>
                            <input type="text" wire:model="nic_passport" class="w-full text-sm border rounded-lg p-2.5">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Basic Salary (LKR) *</label>
                            <input type="number" step="0.01" wire:model="basic_salary" class="w-full text-sm border rounded-lg p-2.5 font-bold">
                            @error('basic_salary') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 bg-slate-50 p-3 rounded-lg border border-slate-200">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">EPF No.</label>
                            <input type="text" wire:model="epf_number" class="w-full text-xs border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">ETF No.</label>
                            <input type="text" wire:model="etf_number" class="w-full text-xs border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">B Card No.</label>
                            <input type="text" wire:model="b_card_no" class="w-full text-xs border rounded p-2">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <button type="button" wire:click="$set('showEditModal', false)" class="px-4 py-2 text-sm text-slate-600">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-sm bg-[#b91c1c] hover:bg-[#a11818] text-white rounded-lg font-bold">Update Employee Record</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
