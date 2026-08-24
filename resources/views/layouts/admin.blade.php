<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEYWork Admin Portal | System Administration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex">

    <!-- Admin Portal Dedicated Sidebar (Indigo / Slate Visual Theme) -->
    <aside class="w-64 shrink-0 bg-slate-900 border-r border-indigo-950/60 p-4 flex flex-col justify-between min-h-screen">
        <div>
            <!-- Admin Brand Badge -->
            <div class="flex items-center gap-3 px-2 py-3 mb-6 bg-indigo-950/40 rounded-xl border border-indigo-800/40">
                <img src="/images/logo.png" alt="CEYWork Logo" class="w-9 h-9 rounded-lg object-cover shadow shrink-0 border border-indigo-700/50" />
                <div>
                    <span class="text-white font-bold text-sm block">CEYWork Admin</span>
                    <span class="text-[10px] text-indigo-400 font-medium block">Control Panel</span>
                </div>
            </div>

            <!-- Admin Nav Links -->
            <nav class="space-y-1 text-sm font-medium">
                <a href="/admin" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>▦</span> Admin Dashboard
                </a>
                <a href="/admin/companies" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>🏢</span> Companies & Branches
                </a>
                <a href="/admin/roles" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>🔑</span> Roles & Permissions
                </a>
                <a href="/admin/users" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>👤</span> User Accounts
                </a>
                <a href="/admin/departments" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>🏛</span> Departments
                </a>
                <a href="/admin/custom-fields" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>🧩</span> Custom Fields Builder
                </a>
                <a href="/admin/workflows" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>🔄</span> Workflow & Approvals
                </a>
                <a href="/admin/audit-logs" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-indigo-900/40 hover:text-white transition">
                    <span>📜</span> Audit Logs
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-slate-800 space-y-3">
            <a href="/dashboard" class="flex items-center justify-between px-3 py-2 text-xs font-semibold text-teal-400 bg-teal-950/40 hover:bg-teal-900/60 rounded-lg border border-teal-800/40 transition">
                <span>← Back to HR Portal</span>
                <span>↗</span>
            </a>
            <div class="flex items-center gap-3 px-2">
                <div class="w-8 h-8 rounded-full bg-indigo-700 flex items-center justify-center font-bold text-white text-xs">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Admin User' }}</p>
                    <p class="text-indigo-400 text-[11px] truncate">System Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Body -->
    <main class="flex-1 p-8 overflow-y-auto">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
