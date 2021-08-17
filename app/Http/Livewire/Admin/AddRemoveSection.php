<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Section;
use App\Models\SectionType;

class AddRemoveSection extends Component
{
    public $layoutRegions = [];
    public $allRegions = [];

    public function mount()
    {
        $this->allRegions = SectionType::all();
        $this->layoutRegions = [
            ['region_id' => '', 'content' => '']
        ];
    }

    public function addRegion()
    {
        $this->layoutRegions[] = ['region_id' => '', 'content' => ''];
    }

    public function removeRegion($index)
    {
        unset($this->layoutRegions[$index]);
        $this->layoutRegions = array_values($this->layoutRegions);
    }
    public function render()
    {
        return view('livewire.admin.add-remove-section');
    }
}
