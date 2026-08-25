<?php

namespace App\Livewire\Assets;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssetManagement extends Component
{
    public array $assets = [];

    // Create / Edit Asset Modal State
    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public ?int $editingAssetId = null;

    public string $name = '';
    public string $code = '';
    public string $category = 'Laptop';
    public string $serial_no = '';
    public string $assigned_to = 'Unassigned';
    public string $condition = 'Good';
    public string $date_assigned = '—';
    public ?string $successMessage = null;

    public function mount()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'Access restricted. Asset Management is available to Administrators and HR Managers only.');
            return redirect()->to('/dashboard');
        }

        $this->assets = [
            [
                'id' => 1,
                'name' => 'MacBook Pro 16"',
                'code' => 'AST-001',
                'category' => 'Laptop',
                'serial_no' => 'C02XJ1GYJGH7',
                'assigned_to' => 'Amara Osei',
                'condition' => 'Good',
                'conditionClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'date_assigned' => 'Feb 2021',
                'icon' => 'laptop',
            ],
            [
                'id' => 2,
                'name' => 'Dell UltraSharp 27"',
                'code' => 'AST-002',
                'category' => 'Monitor',
                'serial_no' => 'CN-0RT85K',
                'assigned_to' => 'Dmitri Volkov',
                'condition' => 'Good',
                'conditionClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'date_assigned' => 'Nov 2021',
                'icon' => 'monitor',
            ],
            [
                'id' => 3,
                'name' => 'iPhone 14 Pro',
                'code' => 'AST-003',
                'category' => 'Phone',
                'serial_no' => 'F4GTQ9AJNP4',
                'assigned_to' => 'Marcus Delgado',
                'condition' => 'Good',
                'conditionClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'date_assigned' => 'Jul 2022',
                'icon' => 'phone',
            ],
            [
                'id' => 4,
                'name' => 'MacBook Air M2',
                'code' => 'AST-004',
                'category' => 'Laptop',
                'serial_no' => 'C02QW3ZXNNN',
                'assigned_to' => 'Priya Nair',
                'condition' => 'Good',
                'conditionClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'date_assigned' => 'Sep 2022',
                'icon' => 'laptop',
            ],
            [
                'id' => 5,
                'name' => 'Logitech MX Keys',
                'code' => 'AST-005',
                'category' => 'Keyboard',
                'serial_no' => '2207LZ71688',
                'assigned_to' => 'Kai Nakamura',
                'condition' => 'Good',
                'conditionClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'date_assigned' => 'Aug 2022',
                'icon' => 'keyboard',
            ],
            [
                'id' => 6,
                'name' => 'ThinkPad X1 Carbon',
                'code' => 'AST-006',
                'category' => 'Laptop',
                'serial_no' => 'R90ZQMH0',
                'assigned_to' => 'Unassigned',
                'condition' => 'In Repair',
                'conditionClass' => 'bg-amber-50 text-amber-800 border-amber-200',
                'date_assigned' => '—',
                'icon' => 'laptop',
            ],
        ];
    }

    public function openCreateModal(): void
    {
        $this->reset(['name', 'code', 'serial_no', 'assigned_to', 'editingAssetId']);
        $this->category = 'Laptop';
        $this->condition = 'Good';
        $this->date_assigned = '—';
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
    }

    public function openEditModal(int $id): void
    {
        foreach ($this->assets as $asset) {
            if ($asset['id'] === $id) {
                $this->editingAssetId = $id;
                $this->name = $asset['name'];
                $this->code = $asset['code'];
                $this->category = $asset['category'];
                $this->serial_no = $asset['serial_no'];
                $this->assigned_to = $asset['assigned_to'];
                $this->condition = $asset['condition'];
                $this->date_assigned = $asset['date_assigned'];
                $this->showEditModal = true;
                break;
            }
        }
    }

    public function createAsset(): void
    {
        $this->validate([
            'name' => 'required|min:3|max:100',
            'code' => 'required',
            'serial_no' => 'required',
        ]);

        $newId = count($this->assets) + 1;
        $newAsset = [
            'id' => $newId,
            'name' => $this->name,
            'code' => $this->code,
            'category' => $this->category,
            'serial_no' => $this->serial_no,
            'assigned_to' => $this->assigned_to ?: 'Unassigned',
            'condition' => $this->condition,
            'conditionClass' => $this->condition === 'Good' ? 'bg-sky-50 text-sky-700 border-sky-200' : 'bg-amber-50 text-amber-800 border-amber-200',
            'date_assigned' => $this->assigned_to !== 'Unassigned' ? date('M Y') : '—',
            'icon' => strtolower($this->category) === 'monitor' ? 'monitor' : (strtolower($this->category) === 'phone' ? 'phone' : (strtolower($this->category) === 'keyboard' ? 'keyboard' : 'laptop')),
        ];

        array_unshift($this->assets, $newAsset);

        $this->successMessage = 'Asset "' . $this->name . '" registered successfully!';
        $this->showCreateModal = false;
    }

    public function updateAsset(): void
    {
        $this->validate([
            'name' => 'required|min:3|max:100',
            'code' => 'required',
            'serial_no' => 'required',
        ]);

        foreach ($this->assets as &$asset) {
            if ($asset['id'] === $this->editingAssetId) {
                $asset['name'] = $this->name;
                $asset['code'] = $this->code;
                $asset['category'] = $this->category;
                $asset['serial_no'] = $this->serial_no;
                $asset['assigned_to'] = $this->assigned_to;
                $asset['condition'] = $this->condition;
                $asset['conditionClass'] = $this->condition === 'Good' ? 'bg-sky-50 text-sky-700 border-sky-200' : 'bg-amber-50 text-amber-800 border-amber-200';
                $asset['date_assigned'] = $this->date_assigned;
                break;
            }
        }

        $this->successMessage = 'Asset "' . $this->name . '" updated successfully by Admin!';
        $this->showEditModal = false;
    }

    public function deleteAsset(int $id): void
    {
        $this->assets = array_values(array_filter($this->assets, fn($a) => $a['id'] !== $id));
        $this->successMessage = 'Asset deleted successfully!';
    }

    public function dismissSuccessMessage(): void
    {
        $this->successMessage = null;
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $inRepairCount = collect($this->assets)->where('condition', 'In Repair')->count();

        return view('livewire.assets.asset-management', [
            'user' => $user,
            'assetsList' => $this->assets,
            'inRepairCount' => $inRepairCount,
        ])->layout('components.layout.app', [
            'title' => 'Asset Management - CEYWork'
        ]);
    }
}
