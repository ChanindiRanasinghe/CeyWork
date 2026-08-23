<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Design System Test</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-50">
    <div class="p-8 space-y-6 max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-neutral-900">Component Test</h1>

        <div class="flex gap-2">
            <x-badge status="active">Active</x-badge>
            <x-badge status="on-leave">On Leave</x-badge>
            <x-badge status="new">New</x-badge>
            <x-badge status="shortlisted">Shortlisted</x-badge>
            <x-badge status="rejected">Rejected</x-badge>
        </div>

        <div class="grid grid-cols-4 gap-4">
            <x-stat-card label="Total Employees" value="284" delta="+3 vs last month" trend="up" icon="👥" />
            <x-stat-card label="Open Positions" value="17" delta="+2 vs last month" trend="up" icon="💼" />
            <x-stat-card label="Pending Leaves" value="8" delta="-1 vs last month" trend="down" icon="🗓" />
            <x-stat-card label="Monthly Payroll" value="Rs. 2.41M" delta="+1.7% vs last month" trend="up" icon="💲" />
        </div>

        <x-alert-banner dismissible>
            3 leave requests pending approval · Payroll run due Aug 25
        </x-alert-banner>

        <div class="flex gap-3">
            <x-button>Sign In</x-button>
            <x-button variant="success">Activate Account</x-button>
            <x-button variant="secondary">Secondary</x-button>
        </div>

        <div class="flex gap-3">
            <x-avatar name="Amara Osei" />
            <x-avatar name="Marcus Delgado" />
            <x-avatar name="Priya Nair" size="lg" />
        </div>

        <x-card title="Test Card">
            <p class="text-sm text-neutral-700">If this card has a cream background, rounded corners, and a subtle shadow, the tokens are wired up correctly.</p>
        </x-card>
    </div>
</body>
</html>
