<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\Page;

class PageManagement extends Component
{


    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'slug' => '',
    ];
    public Page $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshPages' => '$refresh'];

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.slug' => 'required',
            'editing.layout_id' => 'required',
            'editing.meta_title' => 'required|min:3',
            'editing.meta_description' => 'required|min:3',
            'editing.meta_keyword' => 'required|min:3',

        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPage();

    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'pages.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' Pages');
    }

    public function makeBlankPage()
    {
        return Page::make(['title' => '', 'slug' => '','meta_title'=>'','meta_description'=>'','meta_keyword'=>'']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankPage();
        $this->showEditModal = true;
    }

    public function edit(Page $page)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($page)) $this->editing = $page;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->brand_id=1;

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = Page::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
            ->when($this->filters['search'], fn($query, $search) => $query->where('slug', 'like', '%' . $search . '%'));

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
        return view('livewire.admin.page-management',[
            'pages' => $this->rows,
        ]);
    }
}
