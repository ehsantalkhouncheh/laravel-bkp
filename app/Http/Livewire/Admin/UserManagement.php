<?php

namespace App\Http\Livewire\Admin;


use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

use Spatie\Permission\Models\Role;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class UserManagement extends Component
{


    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'email' => '',
    ];
    public $roles;
    public $validationData;
    public $password;
    public $password_confirmation;
    public $selectedRole = [];
    public User $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function rules()
    {

        return [
            'editing.name' => 'required|min:3',
            'editing.email' => 'required|min:3|unique:users,email',
            'password' => 'min:8|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ];
    }

    public function mount()
    {

        $this->editing = $this->makeBlankUser();

        $this->roles = Role::all();

    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {

            echo $this->selectedRowsQuery->toCsv();

        }, 'users.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' users');
    }

    public function makeBlankUser()
    {
        return User::make(['name' => '', 'email' => '', 'password' => '']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }


    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->selectedRole = [];

        $this->password = '';

        $this->password_confirmation = '';

        $this->showEditModal = true;

        $this->validationData = [
            'editing.name' => 'required|min:3',
            'editing.email' => 'required|email|min:3|unique:users,email',
            'password' => 'min:8|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ];
    }

    public function edit(User $user)
    {

        $this->useCachedRows();

        if ($this->editing->isNot($user)) $this->editing = $user;

        $this->selectedRole = $user->roles->pluck('name', 'id')->toArray();

        $this->showEditModal = true;

        $this->validationData = [
            'editing.name' => 'required|min:3',
            'editing.email' => 'required|min:3|unique:users,email,' . $this->editing->id,
        ];

    }

    public function save()
    {
        $this->validate($this->validationData);

        if ($this->password) {

            $this->editing->password = bcrypt($this->password);

        }

        $this->editing->save();

        $userRoles = array_keys(array_filter($this->selectedRole));

        $this->editing->syncRoles($userRoles);

        $this->showEditModal = false;

        $this->resetValidation();

    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()

            ->when($this->filters['email'], fn($query, $email) => $query->where('email', $email))

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
        return view('livewire.admin.user-management', [
            'users' => $this->rows,
        ]);
    }
}
