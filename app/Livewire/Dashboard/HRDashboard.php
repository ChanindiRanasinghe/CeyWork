<?php

namespace App\Livewire\Dashboard;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HRDashboard extends Component
{
    // Notifications Drawer State
    public bool $showNotificationsDrawer = false;
    public string $activeNotificationTab = 'all'; // 'all', 'interviews', 'onboarding', 'offboarding'
    public bool $alertBannerDismissed = false;

    protected $listeners = ['toggleNotificationsDrawer' => 'toggleNotifications'];

    public function mount()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'The HR Management Overview & Notifications are restricted for standard employee accounts.');
            return redirect()->to('/login');
        }
    }

    public function toggleNotifications()
    {
        $this->showNotificationsDrawer = !$this->showNotificationsDrawer;
    }

    public function closeNotifications()
    {
        $this->showNotificationsDrawer = false;
    }

    public function setNotificationTab(string $tab)
    {
        $this->activeNotificationTab = $tab;
    }

    public function dismissAlertBanner()
    {
        $this->alertBannerDismissed = true;
    }

    public function getNotificationsProperty()
    {
        return [
            // Critical & Urgent
            [
                'id' => 1,
                'title' => 'Interview in 2 hours',
                'subtitle' => 'Sam Okafor — Backend Engineer · Technical Round',
                'time' => '10:00 AM Today',
                'level' => 'Critical',
                'category' => 'critical',
                'type' => 'interviews',
                'icon' => 'calendar',
                'unread' => true,
            ],
            [
                'id' => 2,
                'title' => 'Interview scheduled today',
                'subtitle' => 'Grace Liu — Product Manager · Cultural Fit',
                'time' => '2:00 PM Today',
                'level' => 'Critical',
                'category' => 'critical',
                'type' => 'interviews',
                'icon' => 'calendar',
                'unread' => true,
            ],
            [
                'id' => 3,
                'title' => 'Interview tomorrow — prepare',
                'subtitle' => 'Alex Rivera — Backend Engineer · Technical Round',
                'time' => 'Aug 24 · 11:00 AM',
                'level' => 'High',
                'category' => 'critical',
                'type' => 'interviews',
                'icon' => 'calendar',
                'unread' => true,
            ],
            [
                'id' => 4,
                'title' => 'Onboarding starts in 4 days',
                'subtitle' => 'Ravi Sharma · Engineering · Checklist 65% complete',
                'time' => 'Starts Aug 26',
                'level' => 'High',
                'category' => 'critical',
                'type' => 'onboarding',
                'icon' => 'user',
                'unread' => true,
            ],
            [
                'id' => 5,
                'title' => 'Last working day in 9 days',
                'subtitle' => 'Connor Walsh · Sales · Clearance 75% — 1 step blocking',
                'time' => 'Last day: Aug 31',
                'level' => 'Critical',
                'category' => 'critical',
                'type' => 'offboarding',
                'icon' => 'video',
                'unread' => true,
            ],
            [
                'id' => 6,
                'title' => 'Urgent vacancy — 23 days open',
                'subtitle' => 'Finance Controller · Offer stage · 1 remaining candidate',
                'time' => 'Posted Jul 18',
                'level' => 'Critical',
                'category' => 'critical',
                'type' => 'interviews',
                'icon' => 'briefcase',
                'unread' => true,
            ],
            [
                'id' => 7,
                'title' => 'Pipeline milestone: 48 applicants',
                'subtitle' => 'Senior Backend Engineer · 8 shortlisted, interviews in progress',
                'time' => 'Updated today',
                'level' => 'High',
                'category' => 'critical',
                'type' => 'interviews',
                'icon' => 'briefcase',
                'unread' => true,
            ],

            // Needs Attention
            [
                'id' => 8,
                'title' => 'Feedback pending: Carlos Mendes',
                'subtitle' => 'Interview completed Aug 20 — evaluation form not yet submitted',
                'time' => '3 days overdue',
                'level' => 'Medium',
                'category' => 'attention',
                'type' => 'interviews',
                'icon' => 'calendar',
                'unread' => true,
            ],
            [
                'id' => 9,
                'title' => 'Onboarding starts Sep 1',
                'subtitle' => 'Clara Mendes · Marketing · Checklist 20% complete',
                'time' => 'Starts Sep 1',
                'level' => 'Medium',
                'category' => 'attention',
                'type' => 'onboarding',
                'icon' => 'user',
                'unread' => true,
            ],
            [
                'id' => 10,
                'title' => 'Offboarding clearance at 20%',
                'subtitle' => 'Maria Fernandez · Operations · 4 steps remaining',
                'time' => 'Last day: Sep 15',
                'level' => 'Medium',
                'category' => 'attention',
                'type' => 'offboarding',
                'icon' => 'user-minus',
                'unread' => true,
            ],

            // For Your Awareness
            [
                'id' => 11,
                'title' => 'Buddy not yet assigned',
                'subtitle' => 'Yusuf Ibrahim starts Sep 8 — assign an onboarding buddy',
                'time' => 'Sep 8',
                'level' => 'Info',
                'category' => 'awareness',
                'type' => 'onboarding',
                'icon' => 'user',
                'unread' => false,
            ],
            [
                'id' => 12,
                'title' => 'Vacancy filled — offer accepted',
                'subtitle' => 'Ravi Sharma accepted offer for Data Scientist role',
                'time' => 'Aug 20',
                'level' => 'Info',
                'category' => 'awareness',
                'type' => 'interviews',
                'icon' => 'briefcase',
                'unread' => false,
            ],
        ];
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();

        // Department breakdown data
        $departmentsData = [
            ['name' => 'Eng', 'fullName' => 'Engineering', 'count' => 89, 'color' => 'bg-[#b91c1c]'],
            ['name' => 'Sales', 'fullName' => 'Sales & Business', 'count' => 54, 'color' => 'bg-[#d97706]'],
            ['name' => 'Ops', 'fullName' => 'Operations', 'count' => 51, 'color' => 'bg-[#2563eb]'],
            ['name' => 'Product', 'fullName' => 'Product Design', 'count' => 31, 'color' => 'bg-[#16a34a]'],
            ['name' => 'Mktg', 'fullName' => 'Marketing', 'count' => 28, 'color' => 'bg-[#ca8a04]'],
            ['name' => 'Finance', 'fullName' => 'Finance & Legal', 'count' => 19, 'color' => 'bg-[#0d9488]'],
            ['name' => 'HR', 'fullName' => 'Human Resources', 'count' => 12, 'color' => 'bg-[#9333ea]'],
        ];

        // Recent Hires list matching screenshot
        $recentHires = [
            [
                'initials' => 'AO',
                'color' => 'bg-[#b91c1c]',
                'name' => 'Amara Osei',
                'role' => 'Senior Software Engineer · Engineering',
                'date' => 'Feb 14, 2021',
                'status' => 'Active',
                'statusBg' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'initials' => 'MD',
                'color' => 'bg-[#b91c1c]',
                'name' => 'Marcus Delgado',
                'role' => 'Product Manager · Product',
                'date' => 'Jun 3, 2020',
                'status' => 'Active',
                'statusBg' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'initials' => 'PN',
                'color' => 'bg-[#b91c1c]',
                'name' => 'Priya Nair',
                'role' => 'UX Designer · Product',
                'date' => 'Sep 12, 2022',
                'status' => 'Active',
                'statusBg' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'initials' => 'JT',
                'color' => 'bg-[#b91c1c]',
                'name' => 'James Thornton',
                'role' => 'Senior Sales Executive · Sales',
                'date' => 'Jan 7, 2019',
                'status' => 'Active',
                'statusBg' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'initials' => 'LZ',
                'color' => 'bg-[#b91c1c]',
                'name' => 'Ling Zhao',
                'role' => 'Financial Analyst · Finance',
                'date' => 'Mar 20, 2023',
                'status' => 'On Leave',
                'statusBg' => 'bg-amber-50 text-amber-700 border-amber-200',
            ],
        ];

        // Pending Tasks
        $pendingTasks = [
            ['title' => 'Review leave request — James Thornton', 'due' => 'Due Today', 'urgent' => true],
            ['title' => 'Approve August payroll run', 'due' => 'Due Aug 25', 'urgent' => true],
            ['title' => 'Schedule interview — Grace Liu (PM role)', 'due' => 'Due Aug 23', 'urgent' => false],
            ['title' => 'Complete onboarding checklist — Ravi Sharma', 'due' => 'Due Aug 28', 'urgent' => false],
            ['title' => 'Launch Q3 performance review cycle', 'due' => 'Due Sep 5', 'urgent' => false],
        ];

        return view('livewire.dashboard.hr-dashboard', [
            'user' => $user,
            'departmentsData' => $departmentsData,
            'recentHires' => $recentHires,
            'pendingTasks' => $pendingTasks,
            'notifications' => $this->notifications,
        ])->layout('components.layout.app', [
            'user' => $user,
            'title' => 'Overview - CEYWork'
        ]);
    }
}
