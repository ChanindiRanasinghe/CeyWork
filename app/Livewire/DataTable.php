<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class DataTable extends Component
{
    use WithPagination;

    public array $columns = [];
    public ?string $rowView = null;
    public ?string $sortField = null;
    public string $sortDirection = 'asc';
    public int $perPage = 10;

    protected $queryString = ['sortField', 'sortDirection', 'page'];

    public function mount(array $columns, ?string $rowView = null, int $perPage = 10)
    {
        $this->columns = $columns;
        $this->rowView = $rowView;
        $this->perPage = $perPage;
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render(Builder $query)
    {
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return view('livewire.data-table', [
            'rows' => $query->paginate($this->perPage),
        ]);
    }
}
