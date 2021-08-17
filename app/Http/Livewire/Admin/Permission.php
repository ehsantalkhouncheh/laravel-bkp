<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
Use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Permission extends Component
{


    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
    ];
    public SpatiePermission $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshPermissions' => '$refresh'];

    public function rules()
    {
        return [
            'editing.name' => 'required|min:3',
            'editing.guard_name' => 'required|min:3',

        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPermission();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'Permissions.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' Permissions');
    }

    public function makeBlankPermission()
    {
        return SpatiePermission::make(['name' => '', 'guard_name' => '']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankPermission();

        $this->showEditModal = true;
    }

    public function edit(SpatiePermission $permission)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($permission)) $this->editing = $permission;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = SpatiePermission::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where('name', 'like', '%' . $search . '%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.admin.permission', [
            'permissions' => $this->rows,
        ]);
    }
}
