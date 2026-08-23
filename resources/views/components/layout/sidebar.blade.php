@props(['user' => null])

@php
$user = $user ?? auth()->user();

$sections = [
    'Workspace' => array_filter([
        ['label' => 'Dashboard', 'href' => '/dashboard', 'icon' => '▦', 'permission' => null],
        ['label' => 'Employees', 'href' => '/employees', 'icon' => '👥', 'permission' => 'view-all-employees'],
    ], fn($item) => is_null($item['permission']) || ($user && $user->hasPermissionTo($item['permission']))),

    'Recruitment & ATS' => array_filter([
        ['label' => 'Vacancies', 'href' => '/recruitment/vacancies', 'icon' => '🎯', 'permission' => 'manage-vacancies'],
        ['label' => 'Candidates', 'href' => '/recruitment/candidates', 'icon' => '📄', 'permission' => 'manage-candidates'],
        ['label' => 'Interviews', 'href' => '/recruitment/interviews', 'icon' => '🗓', 'permission' => 'schedule-interviews'],
        ['label' => 'Offers & Onboarding', 'href' => '/onboarding', 'icon' => '📋', 'permission' => 'manage-onboarding'],
    ], fn($item) => is_null($item['permission']) || ($user && $user->hasPermissionTo($item['permission']))),

    'Operations' => array_filter([
        ['label' => 'Attendance & Leave', 'href' => '/attendance', 'icon' => '🗓', 'permission' => 'manage-attendance'],
        ['label' => 'Leave Requests', 'href' => '/leave-requests', 'icon' => '📝', 'permission' => 'submit-leave'],
        ['label' => 'Payroll (EPF/ETF)', 'href' => '/payroll', 'icon' => '💲', 'permission' => 'manage-payroll'],
        ['label' => 'Performance', 'href' => '/performance', 'icon' => '📈', 'permission' => 'manage-performance'],
    ], fn($item) => is_null($item['permission']) || ($user && $user->hasPermissionTo($item['permission']))),

    'Administration' => array_filter([
        ['label' => 'Admin Portal', 'href' => '/admin', 'icon' => '⚡', 'permission' => null, 'adminOnly' => true],
        ['label' => 'Reports', 'href' => '/reports', 'icon' => '📊', 'permission' => 'view-hr-reports'],
    ], fn($item) => isset($item['adminOnly']) ? ($user && $user->isAdmin()) : (is_null($item['permission']) || ($user && $user->hasPermissionTo($item['permission'])))),
];
@endphp

<aside class="w-64 shrink-0 bg-slate-900 min-h-screen flex flex-col justify-between px-4 py-6 border-r border-slate-800 text-slate-100">
    <div>
        <div class="flex items-center gap-3 px-2 mb-8">
            <div class="w-9 h-9 rounded-lg bg-teal-600 flex items-center justify-center text-white font-bold text-base shadow-md">
                C
            </div>
            <div>
                <span class="text-white font-bold text-base tracking-wide block">CEYWork</span>
                <span class="text-[10px] text-teal-400 font-semibold tracking-wider uppercase block">Sri Lanka HRMS</span>
            </div>
        </div>

        <nav class="space-y-6">
            @foreach($sections as $section => $items)
                @if(count($items) > 0)
                    <div>
                        <p class="px-3 text-[11px] font-semibold tracking-widest text-slate-400 uppercase mb-2">
                            {{ $section }}
                        </p>
                        <div class="space-y-1">
                            @foreach($items as $item)
                                <x-layout.sidebar-nav-item
                                    :href="$item['href']"
                                    :icon="$item['icon']"
                                    :active="request()->is(ltrim($item['href'], '/').'*')"
                                >
                                    {{ $item['label'] }}
                                </x-layout.sidebar-nav-item>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>
    </div>

    @if($user)
        <div class="flex items-center gap-3 px-2 pt-4 border-t border-slate-800">
            <x-avatar :name="$user->name" size="sm" />
            <div class="min-w-0 flex-1">
                <p class="text-white text-sm font-medium truncate">{{ $user->name }}</p>
                <p class="text-teal-400 text-xs truncate">
                    {{ $user->roles->first()?->name ?? ($user->isAdmin() ? 'Administrator' : 'Employee') }}
                </p>
            </div>
        </div>
    @endif
</aside>
