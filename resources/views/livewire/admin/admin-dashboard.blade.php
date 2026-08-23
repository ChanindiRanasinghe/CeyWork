<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Admin Control Center</h1>
            <p class="text-slate-400 text-sm mt-1">Manage global system configurations, RBAC security, companies, and workflows.</p>
        </div>
        <div class="flex gap-3">
            <a href="/admin/roles" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg text-sm transition shadow-lg shadow-indigo-600/20">
                + Manage RBAC Roles
            </a>
        </div>
    </div>

    <!-- Admin Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Organizations</span>
                <span class="text-xl">🏢</span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-3">{{ $companiesCount }}</p>
            <p class="text-indigo-400 text-xs mt-2 font-medium">CEYWork Tenants</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Active Users</span>
                <span class="text-xl">👤</span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-3">{{ $usersCount }}</p>
            <p class="text-emerald-400 text-xs mt-2 font-medium">Registered Accounts</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">RBAC Roles</span>
                <span class="text-xl">🔑</span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-3">{{ $rolesCount }}</p>
            <p class="text-indigo-400 text-xs mt-2 font-medium">Configured Security Roles</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Departments</span>
                <span class="text-xl">🏛</span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-3">{{ $departmentsCount }}</p>
            <p class="text-teal-400 text-xs mt-2 font-medium">Org Structure</p>
        </div>
    </div>

    <!-- Security & RBAC Roles Grid -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
        <h2 class="text-lg font-bold text-white mb-4">Configured RBAC Roles & Permission Counts</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($roles as $role)
                <div class="bg-slate-950 border border-slate-800/80 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <p class="text-white font-semibold text-sm">{{ $role->name }}</p>
                        <p class="text-slate-400 text-xs mt-0.5">{{ $role->permissions_count }} permissions assigned</p>
                    </div>
                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-indigo-950 text-indigo-300 border border-indigo-800/50">
                        Active
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
