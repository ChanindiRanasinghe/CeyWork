<div class="space-y-8">
    <!-- Top Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome back, {{ auth()->user()->name ?? 'Manager' }}</h1>
            <p class="text-slate-500 text-sm">
                Role: <span class="font-semibold text-teal-700">{{ auth()->user()->roles->first()?->name ?? 'System User' }}</span> · CEYWork Sri Lanka HR Portal
            </p>
        </div>
        <div class="flex gap-3">
            @can('view-all-employees')
                <a href="/employees" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                    View Employee Directory
                </a>
            @endcan
            @can('manage-payroll')
                <a href="/payroll" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                    EPF / ETF Payroll
                </a>
            @endcan
        </div>
    </div>

    <!-- Alert Banner -->
    <x-alert-banner dismissible>
        Notice: EPF/ETF August returns submission deadline is approaching. 3 pending leave requests requiring review.
    </x-alert-banner>

    <!-- Role-Specific KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        <x-stat-card label="Total Headcount" value="{{ $totalEmployees }}" delta="+2 this month" trend="up" icon="👥" />
        <x-stat-card label="Active Employees" value="{{ $activeEmployees }}" delta="100% verified" trend="up" icon="✅" />
        <x-stat-card label="On Leave Today" value="{{ $onLeaveEmployees }}" delta="Approved leaves" trend="down" icon="🗓" />
        <x-stat-card label="Departments" value="{{ $departmentsCount }}" delta="Org Units" trend="up" icon="🏛" />
    </div>

    <!-- Role-Based Section Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Employee Joinings -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold text-slate-900 text-base">Recent Employee Records</h2>
                <a href="/employees" class="text-xs font-semibold text-teal-600 hover:text-teal-800">View All →</a>
            </div>

            <div class="divide-y divide-slate-100">
                @foreach($recentEmployees as $emp)
                    <div class="py-3 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <x-avatar :name="$emp->full_name" size="sm" />
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $emp->full_name }}</p>
                                <p class="text-xs text-slate-500">{{ $emp->designation }} · <span class="font-mono text-slate-400">{{ $emp->employee_code }}</span></p>
                            </div>
                        </div>
                        <x-badge :status="$emp->status">{{ ucfirst($emp->status) }}</x-badge>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Workflow Actions -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
            <h2 class="font-bold text-slate-900 text-base">Quick HR Actions</h2>
            
            <div class="space-y-2">
                @can('submit-leave')
                    <a href="/leave-requests" class="block p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition">
                        <p class="text-xs font-bold text-slate-900">📝 Apply for Leave</p>
                        <p class="text-[11px] text-slate-500 mt-0.5">Submit casual, annual or sick leave request</p>
                    </a>
                @endcan

                @can('manage-vacancies')
                    <a href="/recruitment/vacancies" class="block p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition">
                        <p class="text-xs font-bold text-slate-900">🎯 Recruitment Pipeline</p>
                        <p class="text-[11px] text-slate-500 mt-0.5">View vacancies & schedule interviews</p>
                    </a>
                @endcan

                @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="/admin" class="block p-3 rounded-xl border border-indigo-100 bg-indigo-50/50 hover:bg-indigo-50 transition">
                        <p class="text-xs font-bold text-indigo-900">⚡ CEYWork Admin Portal</p>
                        <p class="text-[11px] text-indigo-600 mt-0.5">Manage roles, permissions & company settings</p>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
