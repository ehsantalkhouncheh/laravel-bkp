<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Layout;
use App\Models\Section;
use App\Models\SectionType;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class LayoutManagement extends Component
{


    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showSectionModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'description' => '',
    ];
    public Layout $editing;

    public $layoutRegions = [];
    public $sectionTypes = [];
    public $layout_id;
    public $removedSectionIds = [];

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshLayouts' => '$refresh'];


    public function rules()
    {
        return [
            'editing.name' => 'required|min:3',
            'editing.description' => 'required|min:3',
        ];
    }

    public function mount()
    {

        $this->editing = $this->makeBlankLayout();
        $this->layoutRegions = $this->makeBlankSection();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'Layouts.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' Layouts');
    }

    public function makeBlankLayout()
    {
        return Layout::make(['name' => '', 'description' => '']);
    }

    public function makeBlankSection()
    {
        return [
            ['type' => '', 'name' => '', 'layout_id' => '']
        ];;
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankLayout();

        $this->selectedSection = [];

        $this->showEditModal = true;
    }

    public function edit(Layout $layout)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($layout)) $this->editing = $layout;

        $this->showEditModal = true;
    }

    public function editSection(Layout $layout)
    {
        $this->useCachedRows();
        $this->layout_id = $layout->id;
        $this->sectionTypes = SectionType::all();
        $this->layoutRegions = Section::where('layout_id', $layout->id)->get()->toArray();
        $this->showSectionModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function saveSection()
    {

        Section::whereIn('id',$this->removedSectionIds)->delete();

        foreach ($this->layoutRegions as $value) {
            Section::updateOrCreate(
                ['name' => $value['name'],'layout_id' => $this->layout_id],
                ['name' => $value['name'], 'type' => $value['type'], 'layout_id' => $this->layout_id]);
        }

        $this->showSectionModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = Layout::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($this->filters['search'], fn($query, $search) => $query->where('description', 'like', '%' . $search . '%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function addRegion()
    {
        $this->layoutRegions[] = ['type' => '', 'name' => ''];
    }

    public function removeRegion($index)
    {
        if(array_key_exists('id',$this->layoutRegions[$index]))
            array_push($this->removedSectionIds,$this->layoutRegions[$index]['id']);
        unset($this->layoutRegions[$index]);
        $this->layoutRegions = array_values($this->layoutRegions);
    }

    public function render()
    {
        return view('livewire.admin.layout-management', [
            'layouts' => $this->rows,
        ]);
    }

}
