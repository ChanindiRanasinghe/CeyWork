<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Sri Lankan Statutory Payroll System</h1>
            <p class="text-slate-500 text-sm">Automated calculation of Basic Salary, Employee EPF (8%), Employer EPF (12%), and Employer ETF (3%).</p>
        </div>
        <div class="flex gap-3">
            <input type="month" wire:model="selectedMonth" class="text-sm border border-slate-300 rounded-lg px-3 py-2">
            <button wire:click="processPayroll" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold text-sm px-4 py-2 rounded-lg shadow-sm">
                ⚡ Run Monthly Payroll Process
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <x-alert-banner dismissible>
            {{ session('message') }}
        </x-alert-banner>
    @endif

    <!-- Statutory Summary Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stat-card label="Total Gross Salary" value="Rs. {{ number_format($totalBasic, 2) }}" delta="Sri Lanka LKR" trend="up" icon="💲" />
        <x-stat-card label="Employee EPF (8%)" value="Rs. {{ number_format($totalEmployeeEPF, 2) }}" delta="Deducted" trend="down" icon="📊" />
        <x-stat-card label="Employer EPF (12%)" value="Rs. {{ number_format($totalEmployerEPF, 2) }}" delta="Company Contribution" trend="up" icon="🏛" />
        <x-stat-card label="Employer ETF (3%)" value="Rs. {{ number_format($totalEmployerETF, 2) }}" delta="Company Contribution" trend="up" icon="🛡" />
    </div>

    <!-- Payroll Breakdown Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
            <h2 class="font-bold text-slate-800 text-sm">Monthly Payslip Preview ({{ $selectedMonth }})</h2>
            <span class="text-xs font-mono text-slate-500 font-medium">Net Payable Total: Rs. {{ number_format($totalNetPayable, 2) }}</span>
        </div>

        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-100 text-slate-700 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3.5">Employee</th>
                    <th class="px-6 py-3.5">EPF / ETF No.</th>
                    <th class="px-6 py-3.5">Basic Salary</th>
                    <th class="px-6 py-3.5">EPF 8% (EE)</th>
                    <th class="px-6 py-3.5">EPF 12% (ER)</th>
                    <th class="px-6 py-3.5">ETF 3% (ER)</th>
                    <th class="px-6 py-3.5">Net Salary</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 font-mono text-xs">
                @foreach($employees as $emp)
                    @php
                        $basic = $emp->basic_salary;
                        $eeEpf = $basic * 0.08;
                        $erEpf = $basic * 0.12;
                        $erEtf = $basic * 0.03;
                        $net = $basic - $eeEpf;
                    @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-sans font-medium text-slate-900">
                            {{ $emp->full_name }}
                            <span class="block text-[11px] text-slate-400 font-mono">{{ $emp->employee_code }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $emp->epf_number ?? 'N/A' }} / {{ $emp->etf_number ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-slate-800 font-semibold">
                            Rs. {{ number_format($basic, 2) }}
                        </td>
                        <td class="px-6 py-4 text-red-600 font-medium">
                            - Rs. {{ number_format($eeEpf, 2) }}
                        </td>
                        <td class="px-6 py-4 text-indigo-600 font-medium">
                            Rs. {{ number_format($erEpf, 2) }}
                        </td>
                        <td class="px-6 py-4 text-teal-600 font-medium">
                            Rs. {{ number_format($erEtf, 2) }}
                        </td>
                        <td class="px-6 py-4 text-emerald-700 font-bold text-sm">
                            Rs. {{ number_format($net, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
