<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Role extends Component
{


    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'guard_name' => '',
    ];
    public $permissions;
    public $selectedPermission = [];
    public SpatieRole $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshRoles' => '$refresh'];

    public function rules()
    {
        return [
            'editing.name' => 'required|min:3',
            'editing.guard_name' => 'required|min:3',

        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankRole();
        $this->permissions = Permission::all();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'Roles.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' Roles');
    }

    public function makeBlankRole()
    {
        return SpatieRole::make(['name' => '', 'guard_name' => '']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankRole();

        $this->selectedPermission =[];

        $this->showEditModal = true;
    }

    public function edit(SpatieRole $role)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($role)) $this->editing = $role;

        $this->selectedPermission = $role->permissions()->pluck('name', 'id')->toArray();

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $rolePermission = array_keys(array_filter($this->selectedPermission));

        $this->editing->syncPermissions($rolePermission);

        $this->showEditModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = SpatieRole::query()
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
        return view('livewire.admin.role', [
            'roles' => $this->rows,
        ]);
    }
}
